<?php

class ServiceDrugController extends Controller {

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
                'actions' => array('create', 'update', 'formdrug', 'getproduct', 'adddrug', 'cutstock','druglist'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new ServiceDrug;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ServiceDrug'])) {
            $model->attributes = $_POST['ServiceDrug'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ServiceDrug'])) {
            $model->attributes = $_POST['ServiceDrug'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ServiceDrug');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ServiceDrug('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ServiceDrug']))
            $model->attributes = $_GET['ServiceDrug'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ServiceDrug the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ServiceDrug::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ServiceDrug $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'service-drug-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFormdrug($seq) {
        $data['type'] = ProductType::model()->findAll("active", '1');
        //$service_id = Yii::app()->request->getPost('seq');
        $data['seq'] = $seq;
        $this->renderPartial('formdrug', $data);
    }

    public function actionGetproduct() {
        $type = Yii::app()->request->getPost('type');
        $sql = "SELECT p.product_id,p.product_name,COUNT(*) AS total
                FROM product p LEFT JOIN items i ON p.product_id = i.product_id
                WHERE p.type_id = '$type' AND i.status = '0' 
                GROUP BY p.product_id ";
        $data['product'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial("product", $data);
    }

    public function actionAdddrug() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $product = Yii::app()->request->getPost('product');
        $branch = Yii::app()->request->getPost('branch');
        $number = Yii::app()->request->getPost('number');
        $user_id = Yii::app()->user->id;
        $seq = Yii::app()->request->getPost('seq');
        $diagcode = Yii::app()->request->getPost('diagcode');

        $columns = array(
            "patient_id" => $patient_id,
            "service_id" => $seq,
            "drug" => $product,
            "number" => $number,
            "diagcode" => $diagcode,
            "branch" => $branch,
            "user_id" => $user_id,
            "date_serv" => date("Y-m-d")
        );

        Yii::app()->db->createCommand()
                ->insert("service_drug", $columns);

        $this->actionCutstock($product, $branch, $number);
    }

    public function actionCutstock($product, $branch, $number) {
        //$product = Yii::app()->request->getPost('product');
        //$branch = Yii::app()->request->getPost('branch');
        //$number = Yii::app()->request->getPost('number');
        $sql = "SELECT i.*
                FROM items i 
                INNER JOIN product p ON i.product_id = p.product_id 
                WHERE i.product_id = '$product' AND p.branch = '$branch' ORDER BY i.date_input,i.expire ASC LIMIT $number";

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $rs):
            $itemcode = $rs['itemcode'];
            Yii::app()->db->createCommand()
                    ->update("items", array("status" => "1"), "itemcode = '$itemcode' ");
        endforeach;
    }

    public function actionDruglist() {
        $seq = Yii::app()->request->getPost('seq');
        $sql = "SELECT p.product_id,p.product_name,SUM(s.number) AS number
                FROM service_drug s INNER JOIN product p ON s.drug = p.product_id
                WHERE s.service_id = '$seq'
                GROUP BY p.product_id ";
        $data['drug'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial("druglist",$data);
    }

}
