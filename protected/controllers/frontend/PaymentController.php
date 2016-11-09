<?php

class PaymentController extends Controller {

    public $layout = "webapp";

    public function actionIndex() {
        $payment = new Payment();
        $data['bank'] = $payment->Get_bank();
        $data['payment'] = $payment->Get_patment();

        $this->render('//payment/view', $data);
    }
    
    public function actionLoadpayment() {
        $howtoorder = new Howtoorder();
        $payment = new Payment();
        $data['bank'] = $payment->Get_bank();
        $data['payment'] = $payment->Get_patment();
        $data['howtoorder'] = $howtoorder->Get_howto();
        $this->renderPartial('//payment/viewload', $data);
    }

}
