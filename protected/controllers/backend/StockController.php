<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StockController extends Controller {

    public $layout = "template_backend";

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
                'users' => array('@'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'expireproduct', 'expireitem', 'checkstockproduct', 'delstock','expire'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render("//backend/index");
    }

    public function actionSet_navbar() {
        $navmenu = $_POST['id'];
        Yii::app()->session['navmenu'] = $navmenu;
    }

    public function actionExpireproduct() {
        $Model = new Alert();
        $data['product'] = $Model->ListAlertproduct();
        $this->render('//backend/stock/expireproduct', $data);
    }

    public function actionExpireitem() {
        $Model = new Alert();
        $data['item'] = $Model->ListAlertExpire();
        $this->render('//backend/stock/expireitem', $data);
    }
    
    public function actionExpire() {
        $Model = new Alert();
        $data['expire'] = $Model->ListExpire();
        $this->render('//backend/stock/expire', $data);
    }

    public function actionCheckstockproduct() {
        $product = Yii::app()->request->getPost('product');
        $branch = Yii::app()->request->getPost('branch');
        $number = Yii::app()->request->getPost('number');

        $sql = "SELECT COUNT(*) AS total 
                FROM items i 
                INNER JOIN product p ON i.product_id = p.product_id 
                WHERE i.product_id = '$product' AND p.branch = '$branch' AND i.status = '0'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($number <= $result['total']) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function actionDelstock() {
        $id = Yii::app()->request->getPost('id');
        $columns = array("flag" => "1");
        Yii::app()->db->createCommand()
                ->update("clinic_storeproduct", $columns, "id = '$id'");
    }

}
