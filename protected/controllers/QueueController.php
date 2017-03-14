<?php

class QueueController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function actionIndex() {
        $Model = new Service();
        $data['seq'] = $Model->Getseq();

        if (Yii::app()->session['status'] == '1' || Yii::app()->session['status'] == '2') {
            $this->render('index', $data);
        } else {
            $this->actionSeqemployee();
        }
    }

    public function actionSeqemployee() {
        $Model = new Service();
        $Patient = new Patient();
        $data['PatientList'] = $Patient->GetPatient();
        $data['seq'] = $Model->Getseq();
        $this->render('seqemployee', $data);
    }

    public function actionSaveseq() {
        $patient = Yii::app()->request->getPost('patient');
        $comment = Yii::app()->request->getPost('comment');
        $branch = Yii::app()->session['branch'];
        //ดึงข้อมูลวันนัดล่าสุดมาอัพเดท
        $sql = "SELECT * FROM appoint WHERE patient = '$patient' AND status = '0' LIMIT 1";
        $appoint = Yii::app()->db->createCommand($sql)->queryRow();
        if($appoint['appoint']){
            $id = $appoint['id'];
            $status = array("status" => '1');
            Yii::app()->db->createCommand()
                    ->update("appoint", $status,"id = '$id'");
        }
        
        
        $columns = array(
            "patient_id" => $patient,
            "comment" => $comment,
            "branch" => $branch,
            "service_date" => date("Y-m-d")
        );
        
        Yii::app()->db->createCommand()
                ->insert("service", $columns);
    }

}
