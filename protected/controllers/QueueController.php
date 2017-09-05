<?php

class QueueController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function actionIndex() {
        $Model = new Service();
        $branch = Yii::app()->session['branch'];
        $data['seq'] = $Model->Getseq($branch);

        if (Yii::app()->session['status'] == '1' || Yii::app()->session['status'] == '2') {
            $this->layout = "dortor";
            $this->render('index', $data);
        } else {
            $this->actionSeqemployee();
        }
    }

    public function actionSeqemployee() {
        $Model = new Service();
        $Patient = new Patient();
        $branch = Yii::app()->session['branch'];
        $data['PatientList'] = $Patient->GetPatient();
        $data['seq'] = $Model->Getseq($branch);
        $this->render('seqemployee', $data);
    }

    public function actionSaveseq() {
        $patient = Yii::app()->request->getPost('patient');
        $comment = Yii::app()->request->getPost('comment');
        $branch = Yii::app()->session['branch'];
        //ดึงข้อมูลวันนัดล่าสุดมาอัพเดท5้ามีการนัด

        $sql = "SELECT * FROM appoint WHERE patient_id = '$patient' AND status = '0' LIMIT 1";
        $appoint = Yii::app()->db->createCommand($sql)->queryRow();
        if ($appoint['appoint']) {
            $id = $appoint['id'];
            $status = array("status" => '1');
            Yii::app()->db->createCommand()
                    ->update("appoint", $status, "id = '$id'");
        }

        $columns = array(
            "patient_id" => $patient,
            "comment" => $comment,
            "branch" => $branch,
            "service_date" => date("Y-m-d")
        );

        Yii::app()->db->createCommand()
                ->insert("service", $columns);
        
        //รหัสบริการมากสุด
        $sqlMaxservice = "SELECT MAX(id) AS id FROM service ";
        $rsService = Yii::app()->db->createCommand($sqlMaxservice)->queryRow();
        $ServiceId = $rsService['id'];
        
        //ตรวจร่างกาย
        $btemp = Yii::app()->request->getPost('btemp');
        $pr = Yii::app()->request->getPost('pr');
        $rr = Yii::app()->request->getPost('rr');
        $weight = Yii::app()->request->getPost('weight');
        $height = Yii::app()->request->getPost('height');
        $ht = Yii::app()->request->getPost('ht');
        $waistline = Yii::app()->request->getPost('waistline');
        $cc = Yii::app()->request->getPost('cc');
        $columnsbody = array(
            "patient_id" => $patient,
            "btemp" => $btemp,
            "pr" => $pr,
            "rr" => $rr,
            "weight" => $weight,
            "height" => $height,
            "ht" => $ht,
            "waistline" => $waistline,
            "cc" => $cc,
            "date_serv" => date("Y-m-d"),
            "user_id" => Yii::app()->user->id,
            "service_id" => $ServiceId
        );

        Yii::app()->db->createCommand()
                ->insert("checkbody", $columnsbody);
    }

    public function actionGetlastservice() {
        $WebConfig = new Configweb_model();
        $patient = Yii::app()->request->getPost('patient');
        //ดึงข้อมูลวันนัดล่าสุดมาอัพเดท
        $sql = "SELECT * FROM appoint WHERE patient_id = '$patient' AND status = '0' ORDER BY id DESC LIMIT 1";
        $appoint = Yii::app()->db->createCommand($sql)->queryRow();
        $type = $this->Gettype($appoint['type']);
        $json = array(
            "appoint_id" => $appoint['id'],
            "comment" => $type,
            "appoint" => $WebConfig->thaidate($appoint['appoint'])
        );

        echo json_encode($json);
    }

    public function actionSaveseqformappoint() {
        $patient = Yii::app()->request->getPost('patient');
        $comment = Yii::app()->request->getPost('comment');
        $appoint_id = Yii::app()->request->getPost('appoint_id');
        $branch = Yii::app()->session['branch'];
        //ดึงข้อมูลวันนัดล่าสุดมาอัพเดท
        //$sql = "SELECT * FROM appoint WHERE patient_id = '$patient' AND status = '0' LIMIT 1";
        //$appoint = Yii::app()->db->createCommand($sql)->queryRow();
        $id = $appoint_id;
        $status = array("status" => '1');
        Yii::app()->db->createCommand()
                ->update("appoint", $status, "id = '$id'");


        $columns = array(
            "patient_id" => $patient,
            "comment" => $comment,
            "branch" => $branch,
            "service_date" => date("Y-m-d")
        );

        Yii::app()->db->createCommand()
                ->insert("service", $columns);
    }

    public function Gettype($type) {
        //$Type = array("1" => "นัดหัตถการ","2" => "นัดพบแพทย์","3" => "ทรีทเม็นท์");
        if ($type == '1') {
            $types = "นัดหัตถการ";
        } else if ($type == '2') {
            $types = "นัดพบแพทย์";
        } else if ($type == '3') {
            $types = "ทรีทเม็นท์";
        }

        return $types;
    }

    public function actionGetdata() {
        $branch = Yii::app()->session['branch'];
        $Model = new Service();
        $data['seq'] = $Model->Getseq($branch);
        $this->renderPartial('table', $data);
    }
    
     public function actionGetservicesuccess() {
        $branch = Yii::app()->session['branch'];
        $Model = new Service();
        $data['seq'] = $Model->GetseqSuccess($branch);
        $this->renderPartial('servicesuccess', $data);
    }

    public function actionDeleteservice() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("service", "id = '$id'");
    }

}
