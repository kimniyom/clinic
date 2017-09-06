<?php

class ServiceController extends Controller {

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
                'actions' => array('create', 'update', 'detail', 'formservice', 'uploadify', 'loadimages', 'checkImages', 'saveservice',
                    'checkresultservice', 'deleteitem', 'sumservice', 'bill'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Service;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Service'])) {
            $model->attributes = $_POST['Service'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Service'])) {
            $model->attributes = $_POST['Service'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Service');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Service('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Service']))
            $model->attributes = $_GET['Service'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Service the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Service::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Service $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'service-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDetail($patient_id, $diagcode) {
        //OpenService
        $data['patient_id'] = $patient_id;
        $Max = Yii::app()->db->createCommand("SELECT MAX(id) AS id FROM service")->queryRow()['id'];
        $data['serviceSEQ'] = ($Max + 1);

        $this->actionCheckImages($data['serviceSEQ']);


        $data['contact'] = PatientContact::model()->find("patient_id = '$patient_id'");
        $data['patient'] = Patient::model()->find("id = '$patient_id'");
        $data['diag'] = Diag::model()->find("diagcode = '$diagcode'");
        $this->renderPartial("detail", $data);
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

    public function actionFormservice($seq) {
        $data['seq'] = $seq;
        $data['model'] = Service::model()->find("id = '$seq'");

        $this->renderPartial("formservice", $data);
    }

    function Randstrgen() {
        $len = 30;
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function actionUploadify($seq = null) {

// Define a destination

        $targetFolder = Yii::app()->baseUrl . '/uploads/img_service'; // Relative to the root
        if (!empty($_FILES)) {

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "img_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

//$targetFile = $targetFolder . '/' . $_FILES['Filedata']['name'];
//$targetFile = $targetFolder . '/' . $Name;
// Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png', 'PNG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
//$GalleryShot = $_FILES['Filedata']['name'];

            /*
              $tempFile = $_FILES['Filedata']['tmp_name'];
              $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
              $targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];

              // Validate the file type
              $fileTypes = array('rar', 'pdf', 'zip'); // File extensions
              $fileParts = pathinfo($_FILES['Filedata']['name']);
             */

            if (in_array($fileParts['extension'], $fileTypes)) {

                $columns = array(
                    'seq' => $seq,
                    'images' => $Name,
                    'create_date' => date("Y-m-d H:i:s")
                );
                Yii::app()->db->createCommand()
                        ->insert("service_images", $columns);

                $width = 1280; //*** Fix Width & Heigh (Autu caculate) ***//
                //$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);
                $images_orig = imagecreatefromjpeg($tempFile);
                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);
                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                imagejpeg($images_fin, "uploads/img_service/" . $Name);
                imagedestroy($images_orig);
                imagedestroy($images_fin);

                //move_uploaded_file($tempFile, $targetFile); เก่า
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionLoadimages() {
        $seq = Yii::app()->request->getPost('seq');
        $data['datas'] = ServiceImages::model()->findAll("seq = '$seq' ");
        $this->renderPartial('images', $data);
    }

    public function actionSaveservice() {
        $id = Yii::app()->request->getPost('id');
        if (!empty($id)) {
            $columns = array(
                //"seq" => Yii::app()->request->getPost('seq'),
                "patient_id" => Yii::app()->request->getPost('patient_id'),
                "diagcode" => Yii::app()->request->getPost('diagcode'),
                "price_total" => Yii::app()->request->getPost('price_total'),
                "service_result" => Yii::app()->request->getPost('service_result'),
                "comment" => Yii::app()->request->getPost('comment'),
                "branch" => Yii::app()->request->getPost('branch'),
                "user_id" => Yii::app()->user->id,
                //"checkbody" => date("Y-m-d"),
                //"service_date" => date("Y-m-d"),
                "d_update" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->update("service", $columns, "id = '$id' ");
        } else {
            $columns = array(
                //"seq" => Yii::app()->request->getPost('seq'),
                "patient_id" => Yii::app()->request->getPost('patient_id'),
                "diagcode" => Yii::app()->request->getPost('diagcode'),
                "price_total" => Yii::app()->request->getPost('price_total'),
                "service_result" => Yii::app()->request->getPost('service_result'),
                "comment" => Yii::app()->request->getPost('comment'),
                "branch" => Yii::app()->request->getPost('branch'),
                "user_id" => Yii::app()->user->id,
                "checkbody" => date("Y-m-d"),
                "service_date" => date("Y-m-d"),
                "d_update" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->insert("service", $columns);
        }
    }

    public function actionCheckresultservice() {
        $service_id = Yii::app()->request->getPost('service_id');
        $result = Service::model()->find("id = '$service_id'");
        if (empty($result['id'])) {
            $val = 0;
        } else {
            $val = 1;
        }
        $json = array("result" => $val);
        echo json_encode($json);
    }

    public function actionDeleteitem() {
        $service_id = Yii::app()->request->getPost('service_id');
        $product_id = Yii::app()->request->getPost('product_id');

        $sql = "SELECT * FROM logserviceproduct WHERE service_id = '$service_id' AND product_id = '$product_id' ";
        $item = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($item as $rs):
            $itemcode = $rs['itemcode'];
            Yii::app()->db->createCommand()
                    ->update("items", array("status" => "0"), "itemcode = '$itemcode' ");
        endforeach;

        Yii::app()->db->createCommand()
                ->delete("logserviceproduct", "service_id = '$service_id' AND product_id = '$product_id' ");

        Yii::app()->db->createCommand()
                ->delete("service_drug", "service_id = '$service_id' AND drug = '$product_id' ");
    }

    public function actionSumservice() {
        $Model = new Service();
        $service_id = Yii::app()->request->getPost('service_id');
        $TOTAL = $Model->SUMservice($service_id);
        echo number_format($TOTAL, 2);
    }

    public function actionBill($service_id) {
        $Model = new Service();
        $data['listdetail'] = $Model->Listservice($service_id);
        $data['detail'] = $Model->GetdetailBillservice($service_id);
        $this->renderPartial('bill', $data);
    }

}
