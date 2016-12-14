<?php

class DoctorController extends Controller {

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
                'actions' => array('create', 'update', 'doctorsearch', 'patientview'),
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
    public function actionIndex() {
        $this->render('index');
    }

    public function actionDoctorsearch() {

        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $b = " ";
        } else {
            $b = " AND branch = '$branch' ";
        }

        $card = Yii::app()->request->getPost('card');
        //$patient = Patient::model()->find("card = '$card' ");
        $sql = "SELECT * FROM patient WHERE card = '$card' $b";
        $patient = Yii::app()->db->createCommand($sql)->queryRow();
        if ($patient['card']) {
            $this->renderPartial('doctorsearch', array("patient" => $patient));
        } else {
            echo "0";
        }
    }

    public function actionPatientview($id, $appoint = null) {
        if (!empty($appoint)) {
            $columns = array("status" => '1');
            Yii::app()->db->createCommand()
                    ->update("appoint", $columns, "id = '$id'");
        }
        $contact = PatientContact::model()->find("patient_id = '$id'");
        $model = Patient::model()->find("id = '$id'");
        $checkbodyModel = new Checkbody();
        $checkbody = $checkbodyModel->Checkbody($id);
        $this->render('patientview', array(
            'model' => $model,
            'contact' => $contact,
            'checkbody' => $checkbody,
        ));
    }

}
