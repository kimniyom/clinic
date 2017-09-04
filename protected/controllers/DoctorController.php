<?php

class DoctorController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'doctorsearch', 'patientview', 'saveservicedetail', 'getdetailservice', 'deletedetailservice', 'saveetc','getdetailserviceetc'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionIndex() {
        $this->render('index');
    }

    public function actionDoctorsearch() {

        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $b = " ";
        } else {
            $b = " AND branch = '$branch' ";
        }

        $card = Yii::app()->request->getPost('card');
        //$patient = Patient::model()->find("card = '$card' ");
        $sql = "SELECT * FROM patient WHERE card = '$card' $b";
        $patient = Yii::app()->db->createCommand($sql)->queryRow();
        if ($patient['card']) {
            $this->renderPartial('doctorsearch', array("patient" => $patient));
        } else {
            echo "0";
        }
    }

    public function actionPatientview($id, $service_id = null) {
        /*
          if (!empty($appoint)) {
          $columns = array("status" => '1');
          Yii::app()->db->createCommand()
          ->update("appoint", $columns, "id = '$id'");
          }
         * 
         */
        $this->layout = "dortor";
        $data['contact'] = PatientContact::model()->find("patient_id = '$id'");
        $data['model'] = Patient::model()->find("id = '$id'");
        $checkbodyModel = new Checkbody();
        $data['checkbody'] = $checkbodyModel->Checkbody($service_id);

        //OpenService
        $data['patient_id'] = $id;
        $data['serviceSEQ'] = ($service_id);
        $data['service_id'] = $service_id;
        //$this->actionCheckImages($data['serviceSEQ']);
        //$data['contact'] = PatientContact::model()->find("patient_id = '$patient_id'");
        $data['patient'] = Patient::model()->find("id = '$id'");


        $this->render('patientview', $data);
    }

    public function actionCheckImages($id) {
        $ServiceID = Service::model()->find("id = '$id'")['id'];
        $img = "";
        if (empty($ServiceID)) {
            $result = ServiceImages::model()->findAll("seq = '$id' ");
            foreach ($result as $rs) {
                $img .= $rs['images'] . "<br/>";
                unlink("./uploads/img_service/" . $rs['images']);
            }

            Yii::app()->db->createCommand()
                    ->delete("service_images", "seq = '$id' ");
        }
        //return $img;
    }

    public function actionSaveservicedetail() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $detail = Yii::app()->request->getPost('detail');
        $comment = Yii::app()->request->getPost('comment');
        $price = Yii::app()->request->getPost('price');
        $service_id = Yii::app()->request->getPost('service_id');
        $doctor = Yii::app()->user->id;

        $columns = array(
            "patient_id" => $patient_id,
            "detail" => $detail,
            "comment" => $comment,
            "price" => $price,
            "service_id" => $service_id,
            "doctor" => $doctor,
            "date_serv" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("service_detail", $columns);
    }

    public function actionComboitem() {
        $items = new Items();
        $data['itemlist'] = $items->GetProductSell();
        /*
          $data['itemlist'] = $items->GetItemSell();
         * 
         */
        $this->renderPartial('comboitem', $data);
    }

    public function actionGetdetailservice($service_id) {
        $sql = "SELECT * FROM service_detail WHERE service_id = '$service_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $grid = "<table style='width:100%;' class='table table-striped'>
                <thead>
                    <tr>
                        <th>การรักษา</th>
                        <th>อื่น ๆ</th>
                        <th style='text-align:right;'>ราคา</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($result as $row):
            $grid .= "<tr>
                        <td style='padding:3px;'>" . $row['detail'] . "</td>
                        <td style='padding:3px;'>" . $row['comment'] . "</td>
                        <td style='padding:3px;text-align:right;'>" . number_format($row['price'], 2) . "</td>
                        <td style='padding:3px;text-align:center;'>
                            <a href='javascript:deletedetailservice(" . $row['id'] . ")'><i class='fa fa-trash text-danger'></i></a>
                        </td>
                    </tr>";
        endforeach;
        $grid .= "</tbody></table>";

        echo $grid;
    }

    public function actionSaveetc() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $detail = Yii::app()->request->getPost('detail_etc');
        $price = Yii::app()->request->getPost('price_etc');
        $service_id = Yii::app()->request->getPost('service_id');
        $doctor = Yii::app()->user->id;
        $columns = array(
            "patient_id" => $patient_id,
            "service_id" => $service_id,
            "detail" => $detail,
            "price" => $price,
            "doctor" => $doctor,
            "date_serv" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("service_etc", $columns);
    }

    public function actionDeletedetailservice() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("service_detail", "id = $id");
    }

    public function actionGetdetailserviceetc($service_id) {
        $sql = "SELECT s.* FROM service_etc s WHERE service_id = '$service_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $grid = "<table style='width:100%;' class='table table-striped'>
                <thead>
                    <tr>
                        <th>รายการ</th>
                        <th style='text-align:right;'>ราคา</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($result as $row):
            $grid .= "<tr>
                        <td style='padding:3px;'>" . $row['detail'] . "</td>
                        <td style='padding:3px;text-align:right;'>" . number_format($row['price'], 2) . "</td>
                        <td style='padding:3px;text-align:center;'>
                            <a href='javascript:deleteetcservice(" . $row['id'] . ")'><i class='fa fa-trash text-danger'></i></a>
                        </td>
                    </tr>";
        endforeach;
        $grid .= "</tbody></table>";

        echo $grid;
    }

}
