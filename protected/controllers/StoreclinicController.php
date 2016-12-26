<?php

class StoreclinicController extends Controller {

    public $layout = 'template_backend';

    public function actionIndex() {
        //$Type = new ProductType();
        //$data['type'] = ProductType::model()->findAll("");
        $this->render('index');
    }
    
    public function actionProducttype() {
        //$Type = new ProductType();
        $data['type'] = ProductType::model()->findAll("");
        $this->render('producttype',$data);
    }

}
