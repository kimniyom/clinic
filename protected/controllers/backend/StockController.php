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
                'actions' => array('create', 'update', 'expireproduct', 'expireitem', 'checkstockproduct'),
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
        $ProductModel = new Backend_Product();
        $data['product'] = $ProductModel->Getstockproductalert();
        $this->render('//backend/stock/expireproduct', $data);
    }

    public function actionExpireitem() {
        $ProductModel = new Backend_Product();
        $data['item'] = $ProductModel->Getstockitemalert();
        $this->render('//backend/stock/expireitem', $data);
    }

    public function actionCheckstockproduct() {
        $product = Yii::app()->request->getPost('product');
        $branch = Yii::app()->request->getPost('branch');
        $number = Yii::app()->request->getPost('number');

        $sql = "SELECT COUNT(*) AS total 
                FROM items i 
                INNER JOIN product p ON i.product_id = p.product_id 
                WHERE i.product_id = '$product' AND p.branch = '$branch' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($number <= $result['total']) {
            echo 1;
        } else {
            echo 0;
        }
    }

    

}
