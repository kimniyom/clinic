<?php

class ContactController extends Controller {

    public $layout = "webapp";

    public function actionIndex() {
        $contact = new Contact();
        $use = new User;
        $pid = Yii::app()->session['pid'];
        $data['contact'] = $contact->gat_contact();
        $data['social'] = $contact->get_social_media();
        $data['use'] = $use->Get_detail($pid);
        $this->render("//contact/contact", $data);
    }
    
    public function actionSave_message(){
        //บันทึกข้อมูลจาก สมาชิก ถึง ผู้ดูแลระบบ
        $columns = array(
            "pid" => $_POST['pid'],
            "message" => $_POST['message'],
            "msg_form" => "U",
            "msg_to" => "A",
            "date_send" => date("Y-m-d H:i:s"),
            "ip" => Yii::app()->request->getUserHostAddress()
        );
        Yii::app()->db->createCommand()
                ->insert("message", $columns);
    }
    
}
