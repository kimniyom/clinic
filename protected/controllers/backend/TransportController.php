<?php
  class TransportController extends Controller{
    public $layout = "template_backend";

    public function actionIndex(){
      $this->render("//backend/transport/create");
    }

    public function actionLoad_data(){
      $transport = new Transport();
      $data['transport'] = $transport->get_transport();
      $this->renderPartial("//backend/transport/view",$data);
    }

    public function actionSave_transport(){
      $columns = array(
        "price" => $_POST['price'],
        "detail" => $_POST['detail']
      );
      Yii::app()->db->createCommand()
        ->insert("transport",$columns);
    }

    public function actionDelete_transport(){
      $id = $_POST['id'];
      Yii::app()->db->createCommand()
        ->delete("transport","id = '$id'");
    }
  }
