<?php

class MessageController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $msg = new Backend_message();
        $data['message'] = $msg->Get_message_all_to_admin();
        $data['message_use'] = $msg->Get_message_all_to_user();
        $data['web'] = new Configweb_model();
        $this->render("//backend/message/view",$data);
    }

    public function actionDetail() {
        $id = $_GET['id'];
        $msg = new Backend_message();
        $web = new Configweb_model();
        $data['web'] = $web;
        $columns = array("status" => '1');
        Yii::app()->db->createCommand()
                ->update("message", $columns, "id = '$id'");
        $data['msg'] = $msg->Get_message_detail($id);
        $this->render("//backend/message/detail", $data);
    }

    public function actionAnswer_msg() {
        $pid = Yii::app()->session['pid'];
        $msg_id = $_POST['msg_id'];
        $columns = array(
            "msg_id" => $msg_id,
            "message" => $_POST['message'],
            "pid" => $pid,
            "date_send" => date("Y-m-d H:i:s"),
            "status" => "0",
            "status_user" => "A",
            "ip" => Yii::app()->request->getUserHostAddress()
        );
        Yii::app()->db->createCommand()
                ->insert("message_answer", $columns);

        //อัพเดทข้อความอื่น ๆ ว่า อ่านแล้ว
        $update = array("status" => '1');

        Yii::app()->db->createCommand()
                ->update("message_answer", $update, "msg_id = '$msg_id' AND status_user = 'U' ");
    }

    public function actionGet_answer() {
        $msg_id = $_POST['msg_id'];
        $msgModel = new Backend_message();
        $web = new Configweb_model();
        $data['web'] = $web;
        $data['answer'] = $msgModel->Get_answer($msg_id);
        $this->renderPartial("//backend/message/answer", $data);
    }

    public function actionDelete_msg() {
        $id = $_POST['id'];
        Yii::app()->db->createCommand()
                ->delete("message", "id = '$id' ");
    }

}
