<?php

class OrdersController extends Controller {

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
                'actions' => array('create', 'update', 'loaddata','save','search'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($order_id = null) {
        $order = Orders::model()->find("order_id = '$order_id'");
        $branchId = $order['branch'];
        $data['BranchModel'] = Branch::model()->find("id = '$branchId'");
        $OrderModel = new Orders();
        $data['order'] = $order;
        $data['orderlist'] = $OrderModel->Getlistorder($order_id);
        $this->render('view',$data);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($branch) {

        $model = new Orders;
        $orderId = $model->autoId("orders", "order_id", "10");

        Yii::app()->db->createCommand()->delete("listorder", "order_id = '$orderId' ");

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
            'order_id' => $orderId,
            'branch' => $branch
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($order_id = null) {
        $order = Orders::model()->find("order_id = '$order_id' ");
        $this->render('update', array(
            'order_id' => $order_id,
            'order' => $order
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($branch = null) {
        $Model = new Orders();
        $data['branch'] = $branch;
        $data['orders'] = $Model->GetorderInBranch($branch);
        $this->render('index', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Orders']))
            $model->attributes = $_GET['Orders'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Orders the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Orders::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Orders $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLoaddata() {
        $orderId = Yii::app()->request->getPost('order_id');

        $OrderModel = new Orders();
        $data['order'] = $OrderModel->Getlistorder($orderId);
        $this->renderPartial('listdata', $data);
    }

    public function actionSave() {
        $branch = Yii::app()->request->getPost('branch');
        $menager = Branch::model()->find("id = '$branch' ")['menagers'];
        $order_id = Yii::app()->request->getPost('order_id');
        $columns = array(
            "order_id" => $order_id,
            "branch" => $branch,
            "author" => $menager,
            "create_date" => date("Y-m-d"),
            "d_update" => date("Y-m-d H:i:s")
        );

        Yii::app()->db->createCommand()->insert("orders", $columns);
    }
    
    public function actionSearch(){
        $Model = new Orders();
        $datestart = Yii::app()->request->getPost('datestart');
        $dateend = Yii::app()->request->getPost('dateend');
        $status =  Yii::app()->request->getPost('status');
        $branch = Yii::app()->request->getPost('branch');
        
        $data['order'] = $Model->SearchOrder($datestart, $dateend, $status,$branch);
        $this->renderPartial('resultsearch',$data);
    }

}
