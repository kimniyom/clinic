<?php

class AppointController extends Controller {

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
                'actions' => array('create', 'update', 'formappoint', 'saveappoint', 'appointover','updateappoint','appointcurrent','appointall'),
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
        $model = new Appoint;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Appoint'])) {
            $model->attributes = $_POST['Appoint'];
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

        if (isset($_POST['Appoint'])) {
            $model->attributes = $_POST['Appoint'];
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
        $dataProvider = new CActiveDataProvider('Appoint');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Appoint('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Appoint']))
            $model->attributes = $_GET['Appoint'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Appoint the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Appoint::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Appoint $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'appoint-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFormappoint($seq = null) {
        $data['seq'] = $seq;
        $data['model'] = Appoint::model()->find("service_id = '$seq'");
        $time = $data['model']['timeappoint'];
        $data['hs'] = trim(substr($time, 0, 2));
        $data['ms'] = trim(substr($time, 3, 2));
        $this->renderPartial('formappoint', $data);
    }

    public function actionSaveappoint() {
        $service_id = Yii::app()->request->getPost('service_id');
        $checkappoint = Appoint::model()->find("service_id = '$service_id' ");
        $id = $checkappoint['id'];
        if (empty($checkappoint['id'])) {
            $columns = array(
                "appoint" => Yii::app()->request->getPost('appoint'),
                "timeappoint" => Yii::app()->request->getPost('time'),
                "service_id" => $service_id,
                "branch" => Yii::app()->request->getPost('branch'),
                "status" => "0",
                "create_date" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->insert("appoint", $columns);
        } else {
            $columns = array(
                "appoint" => Yii::app()->request->getPost('appoint'),
                "timeappoint" => Yii::app()->request->getPost('time'),
                "branch" => Yii::app()->request->getPost('branch'),
                    //"create_date" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->update("appoint", $columns, "id = '$id' ");
        }
    }

    public function actionAppointover() {
        $Model = new Appoint();
        $data['appoint'] = $Model->Appointover();
        $this->render('appointover', $data);
    }

    public function actionUpdateappoint() {
        $id = Yii::app()->request->getPost('id');
        $columns = array(
            "appoint" => Yii::app()->request->getPost('appoint'),
            "timeappoint" => Yii::app()->request->getPost('time'),
                //"create_date" => date("Y-m-d H:i:s")
        );

        Yii::app()->db->createCommand()
                ->update("appoint", $columns, "id = '$id' ");
    }

    public function actionAppointcurrent(){
        $Model = new Appoint();
        $data['appoints'] = $Model->AppointCurrent();
        //print_r($data['appoint']);
        $this->render('appointcurrent',$data);
    }
    
    public function actionAppointAll(){
        $Model = new Appoint();
        $data['appoints'] = $Model->AppointAll();
        //print_r($data['appoint']);
        $this->render('appointall',$data);
    }

}
