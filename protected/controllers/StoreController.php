<?php

class StoreController extends Controller {

    public $layout = 'template_backend';

    public function actionIndex() {
        //$Type = new ProductType();
        //$data['type'] = ProductType::model()->findAll("");
        $data['company'] = Companycenter::model()->find("id = '1'");
        $this->render('index',$data);
    }
    
    public function actionProducttype() {
        //$Type = new ProductType();
        $data['type'] = ProductType::model()->findAll("");
        $this->render('producttype',$data);
    }

}
