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
                'actions' => array('index', 'Detailservice', 'test',
                    'result', 'loadorder', 'sell', 'calculator', 'bill',
                    'confirmorder', 'logsell', 'patient', 'cutstock', 'checkstock', 'deleteitemsinorder'
                ),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        //ลบสินค้าที่ยังไม่ Confirm
        $sql = "SELECT * FROM sell 
                    WHERE sell_id NOT IN(SELECT sell_id FROM logsell)";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $rs):
            $itemcode = $rs['itemcode'];
            $columns = array("status" => "0");
            Yii::app()->db->createCommand()
                    ->update("items", $columns, "itemcode = '$itemcode' AND flag = 'E' ");

            Yii::app()->db->createCommand()
                    ->delete("sell", "itemcode = '$itemcode' ");
        endforeach;

        $this->render('index');
    }

    public function actionSell() {
        $itemcode = Yii::app()->request->getPost('itemcode');
        $card = Yii::app()->request->getPost('card');
        $sellcode = Yii::app()->request->getPost('sellcode');
        $branch = Yii::app()->request->getPost('branch');
        $number = Yii::app()->request->getPost('number');

        $columns = array(
            "itemcode" => $itemcode, 
            "product_id" => $itemcode,
            "card" => $card,
            "sell_id" => $sellcode,
            "user_id" => Yii::app()->user->id,
            "branch" => $branch,
            "number" => $number,
            "date_sell" => date("Y-m-d")
        );
        Yii::app()->db->createCommand()
                ->insert("sell", $columns);

        //ตักสต๊อก
        /*
          $stock = array("status" => "1", "flag" => "E");
          Yii::app()->db->createCommand()
          ->update("items", $stock, "itemcode = '$itemcode'");
         * 
         */
    }

    public function actionLoadorder() {
        $sell_id = Yii::app()->request->getPost('sell_id');
        $sql = "SELECT s.id,p.product_id,c.product_nameclinic AS product_name,SUM(s.number) AS total,p.product_price
                        FROM sell s INNER JOIN clinic_stockproduct p ON s.product_id = p.product_id
                        INNER JOIN center_stockproduct c ON p.product_id = c.product_id
                        WHERE s.sell_id = '$sell_id' 
                        GROUP BY p.product_id";

        $data['order'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('order', $data);
    }

    public function actionCalculator() {
        $sell_id = Yii::app()->request->getPost('sell_id');
        $sql = "SELECT SUM(Q.total) AS total
                FROM
                (
                        SELECT (SUM(s.number) * p.product_price) AS total
                        FROM sell s INNER JOIN clinic_stockproduct p ON s.product_id = p.product_id
                        WHERE s.sell_id = '$sell_id'
                        GROUP BY s.product_id
                ) Q ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $json = array("total" => $result['total']);
        echo json_encode($json);
    }

    public function actionBill($sell_id) {
        $Model = new Sell();
        //$sell_id = Yii::app()->request->getPost('sell_id');
        $data['order'] = $Model->Getlistorder($sell_id);
        $data['detail'] = $Model->Detailorder($sell_id);
        $data['logsell'] = Logsell::model()->find("sell_id = '$sell_id' ");
        $this->renderPartial('bill', $data);
    }

    public function actionConfirmorder($sell_id = null) {
        $Model = new Sell();
        $order = $Model->Getlistorder($sell_id);
        foreach ($order as $rs):
            $product_id = $rs['product_id'];
            $number = $rs['total'];
            $this->actionCutstock($product_id, $number);
            /*
              $itemcode = $rs['itemcode'];
              $columns = array("status" => "1");
              Yii::app()->db->createCommand()
              ->update("items", $columns, "itemcode = '$itemcode' ");
             * 
             */
        endforeach;

        /*
          $confirm = array("confirm" => '1');
          Yii::app()->db->createCommand()
          ->update("sell", $confirm, "sell_id = '$sell_id' ");
         * 
         */
    }

    public function actionLogsell() {
        //$itemcode = Yii::app()->request->getPost('itemcode');

        $card = Yii::app()->request->getPost('card');
        $sellcode = Yii::app()->request->getPost('sellcode');
        $branch = Yii::app()->request->getPost('branch');
        $total = Yii::app()->request->getPost('total');
        $income = Yii::app()->request->getPost('income');
        $change = Yii::app()->request->getPost('change');
        $totalfinal = Yii::app()->request->getPost('totalfinal');
        $distcount = Yii::app()->request->getPost('distcount');

        $CheckOrder = Logsell::model()->find("sell_id = '$sellcode' ");
        if (empty($CheckOrder['sell_id'])) {
            $columns = array(
                "card" => $card,
                "sell_id" => $sellcode,
                "user_id" => Yii::app()->user->id,
                "branch" => $branch,
                "total" => $total,
                "income" => $income,
                "change" => $change,
                "totalfinal" => $totalfinal,
                "distcount" => $distcount,
                "date_sell" => date("Y-m-d")
            );
            Yii::app()->db->createCommand()
                    ->insert("logsell", $columns);
        } else {
            $columns = array(
                "card" => $card,
                "user_id" => Yii::app()->user->id,
                "branch" => $branch,
                "total" => $total,
                "income" => $income,
                "change" => $change,
                "totalfinal" => $totalfinal,
                "distcount" => $distcount,
                "date_sell" => date("Y-m-d")
            );
            Yii::app()->db->createCommand()
                    ->update("logsell", $columns, "sell_id = '$sellcode'");
        }

        $this->actionConfirmorder($sellcode);
    }

    public function actionPatient() {
        $card = Yii::app()->request->getPost('card');
        $sql = "SELECT p.*,c.tel,c.email,g.grad,g.distcount,g.distcountsell
                    FROM patient p INNER JOIN gradcustomer g ON p.type = g.id
                    INNER JOIN patient_contact c ON p.id = c.patient_id
                    WHERE p.card = '$card' ";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();

        $str = "";
        $str .= "PID : " . $rs['pid'];
        $str .= "<br/>บัตรประชาชน : " . $rs['card'];
        $str .= "<br/>คุณ : " . $rs['name'] . " " . $rs['lname'];
        $str .= "<br/>เบอร์โทรศัพท์ : " . $rs['tel'];
        $str .= "<br/>ประเภทลูกค้า : " . $rs['grad'];
        $str .= "<br/> ส่วนลด : " . $rs['distcountsell'] . " บาท";
        //$str .= "<input type='hidden' id='distcount' class='form-control' value='".$rs['distcountsell']."'/>";
        $str .= "<script>$(document).ready(function(){ $('#distcount').val(" . $rs['distcountsell'] . ");});</script>";
        if ($rs) {
            echo $str;
        }
    }

    public function actionCutstock($product_id, $number) {
        $sql = "SELECT *
                FROM clinic_storeproduct i
                WHERE i.product_id = '$product_id' AND i.total > 0
                ORDER BY i.lotnumber,i.d_update ASC ";

        $item = Yii::app()->db->createCommand($sql)->queryAll();
        //ดึงข้อมูลตารางitem
        $numbercut = 0;
        foreach ($item as $rs):
            $id = $rs['id'];
            $totalinstock = $rs['total']; //คงเหลือในสต๊อกที่ตัดได้
            if ($totalinstock >= $number) { //<==กรณีสินค้าในล๊อตนั้นมีมากกว่า
                $totalstock = ($totalinstock - $number);
                $numbercut = $totalstock;
                $columns = array("total" => $numbercut);
                Yii::app()->db->createCommand()->update("clinic_storeproduct", $columns, "id = '$id' ");
                break;
            } else if ($totalinstock < $number) {//<==กรณีสินค้าในล๊อตนั้นมีน้อยกว่า
                $number = ($number - $totalinstock);
                //$numbercut = $totalstock;
                $columns = array("total" => "0");
                Yii::app()->db->createCommand()->update("clinic_storeproduct", $columns, "id = '$id' ");
            }

        endforeach;
    }

    public function actionCheckstock() {
        $product_id = Yii::app()->request->getPost('product_id');
        $branch = Yii::app()->request->getPost('branch');
        $sql = "SELECT IFNULL(SUM(p.total),0) AS total
                FROM clinic_storeproduct p 
                WHERE p.product_id = '$product_id' AND p.branch = '$branch' AND p.flag ='0'";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        echo $rs['total'];
    }

    public function actionDeleteitemsinorder() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("sell", "id = '$id' ");
    }

}
