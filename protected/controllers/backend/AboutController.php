<?php

class AboutController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('about')
                ->queryRow();

        $data['about'] = $rs;
        $this->render("//backend/about/view", $data);
    }

    public function actionCreate() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('about')
                ->queryRow();

        $data['about'] = $rs;
        $this->render("//backend/about/create", $data);
    }

    public function actionSave() {
        $columns = array("about" => $_POST['about']);
        Yii::app()->db->createCommand()
                ->update("about", $columns, '1=1');
    }

}
