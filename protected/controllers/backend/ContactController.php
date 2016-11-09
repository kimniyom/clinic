<?php

class ContactController extends Controller{
    public $layout = "template_backend";

    public function actionIndex(){
      $contact = new Contact();
      $data['contact'] = $contact->gat_contact();
      $data['social'] = $contact->get_social_media();
      
      $this->render("//backend/contact/view",$data);
    }

    public function actionCreate(){
    	$contact = new Contact();
      $data['contact'] = $contact->gat_contact();
		  $data['massocial'] = $contact->mas_social();
    	$this->render("//backend/contact/create",$data);
    }

    public function actionSave(){
      $contact = new Contact();
      $check = $contact->gat_contact();
  		$columns = array(
        "email" => $_POST['email'],
        "tel" => $_POST['tel']
      );
      if(!empty($check)){
        Yii::app()->db->createCommand()
    			->update("contact",$columns,'1=1');
      } else {
        Yii::app()->db->createCommand()
    			->insert("contact",$columns);
      }
	   }

  public function actionSave_social(){
    $columns = array(
      "social_id" => $_POST['social_id'],
      "account" => $_POST['account']
    );
    Yii::app()->db->createCommand()
      ->insert("contact_social",$columns);
  }

  public function actionGet_data_social(){
    $contact = new Contact();
    $data['social'] = $contact->get_social_media();

    $this->renderPartial("//backend/contact/datasocial",$data);
  }

  public function actionDelete_social(){
    $id = $_POST['id'];
    Yii::app()->db->createCommand()
      ->delete("contact_social","id = '$id' ");
  }

}
