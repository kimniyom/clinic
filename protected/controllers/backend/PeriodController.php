<?php

class PeriodController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $period = new Backend_period();
        $data['model'] = $period;
        $data['result'] = $period->get_period();

        $this->render('//backend/period/index', $data);
    }

    public function actionSave_period() {
        $columns = array("period" => $_POST['period']);
        Yii::app()->db->createCommand()
                ->insert("period", $columns);
    }

    public function actionSet_active() {
        $id = $_POST['id'];
        $culumnsOld = array("active" => '0');
        Yii::app()->db->createCommand()
                ->update("period", $culumnsOld, "1=1");

        $columns = array("active" => '1');
        Yii::app()->db->createCommand()
                ->update("period", $columns, "id = '$id'");
    }

    public function actionDelete() {
        $id = $_POST['id'];

        Yii::app()->db->createCommand()
                ->delete("period", "id = '$id'");
    }

}
