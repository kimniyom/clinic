<?php

class HistoryserviceController extends Controller {

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
                'actions' => array('index','Detailservice','test'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $diagcode = Yii::app()->request->getPost('diagcode');
        $sql = "SELECT * FROM service WHERE patient_id = '$patient_id' AND diagcode = '$diagcode' ORDER BY service_date DESC";
        $data['history'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('history', $data);
    }

    public function actionDetailservice($patient_id, $diagcode,$service) {
        //OpenService
        $data['patient_id'] = $patient_id;
        $data['serviceSEQ'] = $service;
        $data['model'] = Service::model()->find("id = '$service' ");
        $data['contact'] = PatientContact::model()->find("patient_id = '$patient_id'");
        $data['patient'] = Patient::model()->find("id = '$patient_id'");
        $data['diag'] = Diag::model()->find("diagcode = '$diagcode'");
        $this->renderPartial("detailservice", $data);
    }
    
    public function actionTest(){
        echo "12345";
    }
}
