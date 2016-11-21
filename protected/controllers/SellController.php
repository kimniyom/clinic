<?php

class SellController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'Detailservice', 'test', 'result', 'loadorder','sell','calculator','bill','confirmorder'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionSell(){
        $itemcode = Yii::app()->request->getPost('itemcode');
        $card = Yii::app()->request->getPost('card');
        $sellcode = Yii::app()->request->getPost('sellcode');
        $branch = Yii::app()->request->getPost('branch');

        $columns = array(
            "itemcode" => $itemcode,
            "card" => $card,
            "sell_id" => $sellcode,
            "user_id" => Yii::app()->user->id,
            "branch" => $branch,
            "date_sell" => date("Y-m-d")
        );
        Yii::app()->db->createCommand()
            ->insert("sell",$columns);

        //ตักสต๊อก
        $stock = array("status" => "1");
        Yii::app()->db->createCommand()
            ->update("items",$stock,"itemcode = '$itemcode'");
    }
    
    public function actionLoadorder(){
        $sell_id = Yii::app()->request->getPost('sell_id');
        $sql = "SELECT p.product_name,COUNT(*) AS total,p.product_price
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE s.sell_id = '$sell_id' 
                    GROUP BY p.product_id";
        
        $data['order'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('order',$data);
        
    }

    public function actionCalculator(){
        $sell_id = Yii::app()->request->getPost('sell_id');
        $sql = "SELECT SUM(p.product_price) AS total
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE s.sell_id = '$sell_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $json = array("total" => $result['total']);
        echo json_encode($json);
    }

    public function actionBill($sell_id){
        $Model = new sell();
        //$sell_id = Yii::app()->request->getPost('sell_id');
        $data['order'] = $Model->Getlistorder($sell_id);
        $data['detail'] = $Model->Detailorder($sell_id);
        $this->renderPartial('bill',$data);
    }

    public function actionConfirmorder($sell_id = null){
        $Model = new sell();
        $order = $Model->Getlistorder($sell_id);
        foreach($order as $rs):
            $itemcode = $rs['itemcode'];
            $columns = array("status" => "1");
            Yii::app()->db->createCommand()
                ->update("items",$columns,"itemcode = '$itemcode' ");
        endforeach;

        $confirm = array("confirm" => '1');
        Yii::app()->db->createCommand()
                ->update("sell",$confirm,"sell_id = '$sell_id' ");
    }

}
