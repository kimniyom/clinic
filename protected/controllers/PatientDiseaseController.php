<?php

class PatientDiseaseController extends Controller {

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
                'actions' => array('create', 'update','getdisease','adddisease','deletedisease','getdiseaseview'),
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
    public function actionCreate($id) {
        $model = new PatientDisease;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PatientDisease'])) {
            $model->attributes = $_POST['PatientDisease'];
            $model->d_update = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('patient/view', 'id' => $id));
        }

        $this->render('create', array(
            'model' => $model,
            'patient_id' => $id
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

        if (isset($_POST['PatientDisease'])) {
            $model->attributes = $_POST['PatientDisease'];
            $model->d_update = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'patient_id' => $model->patient_id,
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
        $dataProvider = new CActiveDataProvider('PatientDisease');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PatientDisease('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PatientDisease']))
            $model->attributes = $_GET['PatientDisease'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PatientDisease the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PatientDisease::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PatientDisease $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-disease-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetdisease() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $data['patientdisease'] = PatientDisease::model()->findAll("patient_id = '$patient_id' ");

        $this->renderPartial('getdisease', $data);
    }
    
    public function actionGetdiseaseview() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $data['patientdisease'] = PatientDisease::model()->findAll("patient_id = '$patient_id' ");

        $this->renderPartial('getdiseaseview', $data);
    }
    
    

    public function actionAdddisease() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $disease = Yii::app()->request->getPost('disease');
        $columns = array("patient_id" => $patient_id, "disease" => $disease, "d_update" => date("Y-m-d H:i:s"));
        Yii::app()->db->createCommand()
                ->insert("patient_disease", $columns);
    }

    public function actionDeletedisease() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("patient_disease", "id = '$id' ");
    }

}
