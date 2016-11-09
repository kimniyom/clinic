<?php

class MessageController extends Controller {

    public $layout = "webapp";

    public function actionIndex() {
        $msg = new Message();
        $data['web'] = new Configweb_model();
        $pid = Yii::app()->session['pid'];
        $data['model'] = $msg;
        $data['msg'] = $msg->Get_message_all_to_admin($pid);
        $this->render("//message/view", $data);
    }

    public function actionDetail() {
        $msg_id = $_GET['id'];
        $msg = new Message();
        $web = new Configweb_model();
        $data['web'] = $web;
        $columns = array("status" => '1');
        Yii::app()->db->createCommand()
                ->update("message_answer", $columns, "msg_id = '$msg_id' AND status_user = 'A' ");
        $data['msg'] = $msg->Get_message_detail($msg_id);
        $this->render("//message/detail", $data);
    }

    public function actionGet_answer() {
        $msg_id = $_POST['msg_id'];
        //อัพเดทตารางหลัก
        $columns = array("status" => '0');
        Yii::app()->db->createCommand()
                ->update("message", $columns,"id = '$msg_id' ");
        $msgModel = new Message();
        $web = new Configweb_model();
        $data['web'] = $web;
        $data['answer'] = $msgModel->Get_answer($msg_id);
        $this->renderPartial("//message/answer", $data);
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
            "status_user" => "U",
            "ip" => Yii::app()->request->getUserHostAddress()
        );
        Yii::app()->db->createCommand()
                ->insert("message_answer", $columns);

        //อัพเดทข้อความอื่น ๆ ว่า อ่านแล้ว
        $update = array("status" => '1');

        Yii::app()->db->createCommand()
                ->update("message_answer", $update, "msg_id = '$msg_id' AND status_user = 'A' ");
    }

}
