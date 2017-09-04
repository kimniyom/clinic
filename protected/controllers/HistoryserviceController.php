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
                'actions' => array('index', 'Detailservice', 'test', 'result', 'historyall','historyresult','historyallmain'),
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
        $sql = "SELECT * FROM service WHERE patient_id = '$patient_id' AND diagcode = '$diagcode' ORDER BY id DESC";
        $data['history'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('history', $data);
    }

    public function actionDetailservice($patient_id, $diagcode, $service) {
        //OpenService
        $data['patient_id'] = $patient_id;
        $data['serviceSEQ'] = $service;
        $data['model'] = Service::model()->find("id = '$service' ");
        $data['contact'] = PatientContact::model()->find("patient_id = '$patient_id'");
        $data['patient'] = Patient::model()->find("id = '$patient_id'");
        $data['diag'] = Diag::model()->find("diagcode = '$diagcode'");
        $this->renderPartial("detailservice", $data);
    }

    public function actionTest() {
        echo "12345";
    }

    public function actionResult() {
        $CheckbodyModel = new Checkbody();
        $drugModel = new ServiceDrug();
        $service_id = Yii::app()->request->getPost('service_id');

        $service = Service::model()->find("id = '$service_id'");
        $data['service'] = $service;
        $data['patient'] = Patient::model()->find("id", $service['patient_id']);
        $data['checkbody'] = $CheckbodyModel->Getdetail($service['patient_id'], $service['checkbody']);
        $data['drug'] = $drugModel->Getservicedrug($service_id);
        $data['appoint'] = Appoint::model()->find("service_id = '$service_id' ");
        $data['images'] = ServiceImages::model()->findAll("seq = '$service_id' ");
        $this->renderPartial('result', $data);
    }

    public function actionHistoryall() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT s.*,d.diagname,c.cc
                    FROM service s INNER JOIN diag d ON s.diagcode = d.diagcode
                    INNER JOIN checkbody c ON s.checkbody = c.date_serv
                    WHERE s.patient_id = '$patient_id' ORDER BY s.id DESC";
        $data['service'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('historyall', $data);
    }
    
    public function actionHistoryallmain() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT s.*,d.diagname,c.cc
                    FROM service s INNER JOIN diag d ON s.diagcode = d.diagcode
                    INNER JOIN checkbody c ON s.checkbody = c.date_serv
                    WHERE s.patient_id = '$patient_id' ORDER BY s.id DESC";
        $data['service'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('historyallmain', $data);
    }
    
    public function actionHistoryresult($service_id) {
        $CheckbodyModel = new Checkbody();
        $drugModel = new ServiceDrug();
        //$service_id = Yii::app()->request->getPost('service_id');

        $service = Service::model()->find("id = '$service_id'");
        $data['service'] = $service;
        $data['patient'] = Patient::model()->find("id", $service['patient_id']);
        $data['checkbody'] = $CheckbodyModel->Getdetail($service['patient_id'], $service['checkbody']);
        $data['drug'] = $drugModel->Getservicedrug($service_id);
        $data['appoint'] = Appoint::model()->find("service_id = '$service_id' ");
        $data['images'] = ServiceImages::model()->findAll("seq = '$service_id' ");
        $this->renderPartial('historyresult', $data);
    }

}
