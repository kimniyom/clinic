<?php

class HowtoorderController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $rs = Yii::app()->db->createCommand()
                ->select("*")
                ->from("howtoorder")
                ->queryRow();

        $data['howtoorder'] = $rs['howto'];
        $this->render("//backend/howtoorder/view", $data);
    }

    public function actionCreate() {
        $rs = Yii::app()->db->createCommand()
                ->select("*")
                ->from("howtoorder")
                ->queryRow();

        $data['howtoorder'] = $rs['howto'];
        $this->render("//backend/howtoorder/create", $data);
    }

    public function actionSave() {
        $columns = array("howto" => $_POST['howto']);
        $rs = Yii::app()->db->createCommand()
                ->select("*")
                ->from("howtoorder")
                ->queryRow();
        if (empty($rs)) {
            Yii::app()->db->createCommand()
                    ->insert("howtoorder", $columns);
        } else {

            Yii::app()->db->createCommand()
                    ->update("howtoorder", $columns, "1=1");
        }
    }

}
