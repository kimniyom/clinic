<?php

class WebController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $query = Yii::app()->db->createCommand()
                ->select('*')
                ->from('webname')
                ->order('id ASC')
                ->queryRow();
        if (!empty($query)) {
            $webname = $query['webname'];
        } else {
            $webname = "กรอกชื่อร้าน";
        }
        $data['web'] = new Configweb_model();
        $data['webname'] = $webname;
        $this->render('//backend/webname/index', $data);
    }

    public function actionSave_webname() {
        $name = $_POST['webname'];
        $query = Yii::app()->db->createCommand()
                ->select('*')
                ->from('webname')
                ->order('id ASC')
                ->queryRow();
        if (!empty($query)) {
            $id = $query['id'];
            $columns = array("webname" => $name);
            Yii::app()->db->createCommand()
                    ->update("webname", $columns, "id = '$id' ");
        } else {
            $columns = array("webname" => $name);
            Yii::app()->db->createCommand()
                    ->insert("webname", $columns);
        }
    }

}
