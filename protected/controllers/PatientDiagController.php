<?php

class PatientDiagController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('create', 'update', 'getdiag', 'adddiag', 'deletediag', 'getpricediag',
                    'saveservicediag','getdetaildiag','deletediagservice','getdetaildiagview'),
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
        $model = new PatientDiag;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PatientDiag'])) {
            $model->attributes = $_POST['PatientDiag'];
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

        if (isset($_POST['PatientDiag'])) {
            $model->attributes = $_POST['PatientDiag'];
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
        $dataProvider = new CActiveDataProvider('PatientDiag');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PatientDiag('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PatientDiag']))
            $model->attributes = $_GET['PatientDiag'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PatientDiag the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PatientDiag::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PatientDiag $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-diag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetdiag() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $data['patientdiag'] = PatientDiag::model()->findAll("patient_id = '$patient_id' ");
        //Check Body 

        $CheckModel = new Checkbody();

        $data['checkbody'] = $CheckModel->Checkbody($patient_id);
        $this->renderPartial('getdiag', $data);
    }

    public function actionAdddiag() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $diag = Yii::app()->request->getPost('diag');
        $columns = array("patient_id" => $patient_id, "diag" => $diag, "create_date" => date("Y-m-d"));
        Yii::app()->db->createCommand()
                ->insert("patient_diag", $columns);
    }

    public function actionDeletediag() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("patient_diag", "id = '$id' ");
    }

    public function actionGetpricediag() {
        $id = Yii::app()->request->getPost('id');
        $model = Diag::model()->find("diagcode = :id", array(":id" => $id));
        if ($model) {
            echo $model->price;
        } else {
            echo 0;
        }
    }

    public function actionSavediag() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $diag = Yii::app()->request->getPost('diaginsert');
        $price = Yii::app()->request->getPost('pricediag');
        
        /*
        $columns = array("patient_id" => $patient_id, "diag" => $diag, "create_date" => date("Y-m-d"));
        Yii::app()->db->createCommand()
                ->insert("patient_diag", $columns);
         * 
         */
    }
    
    public function actionSaveservicediag(){
        $patient_id = Yii::app()->request->getPost('patient_id');
        $diagcode = Yii::app()->request->getPost('diagcode');
        $diagprice = Yii::app()->request->getPost('diagprice');
        $service_id = Yii::app()->request->getPost('service_id');
        $doctor = Yii::app()->user->id;
        $columns = array(
            "patient_id" => $patient_id,
            "service_id" => $service_id,
            "diagcode" => $diagcode,
            "diagprice" => $diagprice,
            "doctor" => $doctor,
            "date_serv" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("service_diag", $columns);
    }
    
    public function actionGetdetaildiag($service_id) {
        $sql = "SELECT s.*,d.diagname FROM service_diag s INNER JOIN diag d ON s.diagcode = d.diagcode WHERE service_id = '$service_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $grid = "<table style='width:100%;' class='table table-striped'>
                <thead>
                    <tr>
                        <th>หัตถการ</th>
                        <th style='text-align:right;'>ราคา</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($result as $row):
            $grid .= "<tr>
                        <td style='padding:3px;'>" . $row['diagname'] . "</td>
                        <td style='padding:3px;text-align:right;'>" . number_format($row['diagprice'], 2) . "</td>
                        <td style='padding:3px;text-align:center;'>
                            <a href='javascript:deletediagservice(" . $row['id'] . ")'><i class='fa fa-trash text-danger'></i></a>
                        </td>
                    </tr>";
        endforeach;
        $grid .="</tbody></table>";

        echo $grid;
    }
    
    public function actionGetdetaildiagview($service_id) {
        $sql = "SELECT s.*,d.diagname FROM service_diag s INNER JOIN diag d ON s.diagcode = d.diagcode WHERE service_id = '$service_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $grid = "<table style='width:100%;' class='table table-striped'>
                <thead>
                    <tr>
                        <th>หัตถการ</th>
                        <th style='text-align:right;'>ราคา</th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($result as $row):
            $grid .= "<tr>
                        <td style='padding:3px;'>" . $row['diagname'] . "</td>
                        <td style='padding:3px;text-align:right;'>" . number_format($row['diagprice'], 2) . "</td>
                        
                    </tr>";
        endforeach;
        $grid .="</tbody></table>";

        echo $grid;
    }
    
    
    
    public function actionDeletediagservice() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("service_diag", "id = $id");
    }

}
