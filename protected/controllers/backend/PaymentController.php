<?php

class PaymentController extends Controller {

    public $layout = "template_backend";

    public function actionView() {
        $payment = new Payment();
        $data['bank'] = $payment->Get_bank();
        $data['payment'] = $payment->Get_patment();

        $this->render('//backend/payment/view', $data);
    }

    public function actionSave_payment(){
        $columns = array(
            "bank_id" => $_POST['bank_id'],
            "bookbank_name" => $_POST['bookbank_name'],
            "bookbank_number" => $_POST['bookbank_number'],
            "bank_branch" => $_POST['bank_branch']
            );

        Yii::app()->db->createCommand()
            ->insert("payment",$columns);
    }
    
    public function actionLoad_data(){
        $payment = new Payment();
        $data['bank'] = $payment->Get_bank();
        $data['payment'] = $payment->Get_patment();

        $this->renderPartial('//backend/payment/detail', $data);
    }

    public function actionCreate() {
        
    }

    public function actionUpdate() {
        
    }
    
    public function actionDelete_payment(){
        $id = $_POST['id'];
        Yii::app()->db->createCommand()
                ->delete("payment","id = '$id' ");
    }

}
