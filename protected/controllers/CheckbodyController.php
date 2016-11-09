<?php

class CheckbodyController extends Controller {

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
                'actions' => array('create', 'update', 'check', 'save', 'saveupdate', 'Historyview'),
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
    public function actionView() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $date = date("Y-m-d");
        $sql = "SELECT * FROM checkbody WHERE patient_id = '$patient_id' AND date_serv = '$date' ";

        $data['checkbody'] = Yii::app()->db->createCommand($sql)->queryRow();
        $this->renderPartial('view', $data);
    }

    public function actionHistoryview() {
        $date = Yii::app()->request->getPost('date');
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT * FROM checkbody WHERE patient_id = '$patient_id' AND date_serv = '$date' ";
        
        $data['checkbody'] = Yii::app()->db->createCommand($sql)->queryRow();
        $this->renderPartial('historyview', $data);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Checkbody;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Checkbody'])) {
            $model->attributes = $_POST['Checkbody'];
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

        if (isset($_POST['Checkbody'])) {
            $model->attributes = $_POST['Checkbody'];
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
        $dataProvider = new CActiveDataProvider('Checkbody');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Checkbody('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Checkbody']))
            $model->attributes = $_GET['Checkbody'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Checkbody the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Checkbody::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Checkbody $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'checkbody-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCheck() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $date = date("Y-m-d");
        $sql = "SELECT * FROM checkbody WHERE patient_id = '$patient_id' AND date_serv = '$date'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        $data['patient_id'] = $patient_id;
        if (!empty($result['patient_id'])) {
            $data['result'] = $result;
            $this->renderPartial('formupdate', $data);
        } else {
            $this->renderPartial('formcreate', $data);
        }
    }

    public function actionFormcheckbody() {
        
    }

    public function actionSave() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $btemp = Yii::app()->request->getPost('btemp');
        $pr = Yii::app()->request->getPost('pr');
        $rr = Yii::app()->request->getPost('rr');
        $weight = Yii::app()->request->getPost('weight');
        $height = Yii::app()->request->getPost('height');
        $ht = Yii::app()->request->getPost('ht');
        $waistline = Yii::app()->request->getPost('waistline');
        $cc = Yii::app()->request->getPost('cc');
        $columns = array(
            "patient_id" => $patient_id,
            "btemp" => $btemp,
            "pr" => $pr,
            "rr" => $rr,
            "weight" => $weight,
            "height" => $height,
            "ht" => $ht,
            "waistline" => $waistline,
            "cc" => $cc,
            "date_serv" => date("Y-m-d"),
            "user_id" => Yii::app()->user->id
        );

        Yii::app()->db->createCommand()
                ->insert("checkbody", $columns);
    }

    public function actionSaveupdate() {
        $id = Yii::app()->request->getPost('id');
        $patient_id = Yii::app()->request->getPost('patient_id');
        $btemp = Yii::app()->request->getPost('btemp');
        $pr = Yii::app()->request->getPost('pr');
        $rr = Yii::app()->request->getPost('rr');
        $weight = Yii::app()->request->getPost('weight');
        $height = Yii::app()->request->getPost('height');
        $ht = Yii::app()->request->getPost('ht');
        $waistline = Yii::app()->request->getPost('waistline');
        $cc = Yii::app()->request->getPost('cc');
        $columns = array(
            "patient_id" => $patient_id,
            "btemp" => $btemp,
            "pr" => $pr,
            "rr" => $rr,
            "weight" => $weight,
            "height" => $height,
            "ht" => $ht,
            "waistline" => $waistline,
            "cc" => $cc,
            //"date_serv" => date("Y-m-d"),
            "user_id" => Yii::app()->user->id
        );

        Yii::app()->db->createCommand()
                ->update("checkbody", $columns, "id = '$id'");
    }

}
