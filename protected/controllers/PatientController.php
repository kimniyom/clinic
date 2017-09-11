<?php

class PatientController extends Controller {

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
                'actions' => array('index', 'view', 'checkpatient',
                'save_upload', 'getdata', 'history', 'appoint', 'sellhistory','getappointpatient',
                'deleteappoint','detailsell','delete'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'dortorsearch','delete'),
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
        $contact = PatientContact::model()->find("patient_id = '$id'");
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'contact' => $contact,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Patient;
        $config = new Configweb_model();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Patient'])) {
            $model->attributes = $_POST['Patient'];
            $cid = $_POST['Patient']['card'];
            $model->card = str_replace("-", "", $cid);
            $model->pid = $config->autoId("patient", "pid", "10");
            $model->d_update = date("Y-m-d");
            $model->emp_id = Yii::app()->user->id;
            if ($model->save())
                $this->redirect(array('patientcontact/create', 'id' => $model->id));
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

        if (isset($_POST['Patient'])) {
            $model->attributes = $_POST['Patient'];
            $cid = $_POST['Patient']['card'];
            $model->card = str_replace("-", "", $cid);
            $model->d_update = date("Y-m-d");

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
    public function actionDelete() {
        $id = Yii::app()->request->getPost('id');
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        //if (!isset($_GET['ajax'])) $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $branch = Yii::app()->session['branch'];
        $data['branchModel'] = Branch::model()->find('id=:id', array(':id' => $branch));
        $data['branch'] = $branch;
        if ($branch == "99") {
            $BranchList = Branch::model()->findAll();
        } else {
            $BranchList = Branch::model()->findAll("id = '$branch'");
        }

        $data['BranchList'] = $BranchList;
        $this->render('index', $data);
    }

    public function actionGetdata() {
        $branch = Yii::app()->request->getPost('branch');
        if ($branch == "99") {
            $WHERE = "";
        } else {
            $WHERE = "branch = '$branch'";
        }

        $data['patient'] = Patient::model()->findAll($WHERE);
        $this->renderPartial('getdata', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Patient('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Patient']))
            $model->attributes = $_GET['Patient'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Patient the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Patient::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Patient $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCheckpatient() {
        $card = Yii::app()->request->getPost('card');

        $sql = "SELECT COUNT(*)AS total FROM patient WHERE card = '$card'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($result['total']) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function actionSave_upload() {
        $configWeb = new Configweb_model();
        $id = $_GET['id'];
        $targetFolder = Yii::app()->baseUrl . '/uploads/profile'; // Relative to the root

        $sqlCkeck = "SELECT images FROM patient WHERE id = '$id' ";
        $rs = Yii::app()->db->createCommand($sqlCkeck)->queryRow();
        $filename = './uploads/profile/' . $rs['images'];

        if (!file_exists($filename)) {
            unlink('./uploads/profile/' . $rs['images']);
        }

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "file_" . $configWeb->Randstrgen(30) . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $columns = array(
                    "images" => $Name
                );

                Yii::app()->db->createCommand()
                        ->update("patient", $columns, "id = '$id' ");


                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }

        /*
          if (!empty($_FILES)) {
          $tempFile = $_FILES['Filedata']['tmp_name'];
          $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
          $FileName = time() . $_FILES['Filedata']['name'];
          $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

          $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
          $fileParts = pathinfo($_FILES['Filedata']['name']);

          if (in_array($fileParts['extension'], $fileTypes)) {
          move_uploaded_file($tempFile, $targetFile);

          $columns = array(
          "images" => $FileName
          );

          Yii::app()->db->createCommand()
          ->update("masuser", $columns, "pid = '$pid' ");
          echo '1';
          } else {
          echo 'Invalid file type.';
          }
          }
         */
    }

    public function actionDortorsearch() {
        $card = Yii::app()->request->getPost('card');
        $patient = Patient::model()->find("card = '$card' ");
        if ($patient['card']) {
            $this->renderPartial('dortorsearch', array("patient" => $patient));
        } else {
            echo "0";
        }
    }

    public function actionHistory() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT s.*,b.branchname
          FROM service s INNER JOIN branch b ON s.branch = b.id
          WHERE s.patient_id = '$patient_id' AND s.status = '4' ORDER BY s.id DESC";
        $data['history'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('history', $data);
    }

    public function actionAppoint() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT a.id,a.appoint,b.branchname
            FROM appoint a INNER JOIN branch b ON a.branch = b.id
            WHERE a.patient_id = '$patient_id' AND a.status = '0' ORDER BY a.id DESC";
        $data['appoint'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('appoint', $data);
    }

    public function actionSellhistory() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $sql = "SELECT s.*
              FROM logsell s INNER JOIN patient p ON s.card = p.card
              WHERE p.id = '$patient_id '
              ORDER BY s.id ASC";
        $data['sell'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('sellhistory', $data);
    }

    public function actionGetappointpatient() {
        $Model = new Appoint();
        $appoint_id = Yii::app()->request->getPost('appoint_id');
        $appoint = $Model->GetappointPatient($appoint_id);

        $str = "";
        $str .= "<table class='table'><tr><td>วันที่นัด</td><td>".$appoint['appoint']."</td></tr>";
        $str .= "<tr><td>ประเภทนัด</td><td>".$Model->Typeappoint($appoint['type'])."</td></tr>";
        $str .= "<tr><td>อื่น ๆ</td><td>".$appoint['etc']."</td></tr>";
        $str .="</table>";

        echo $str;
    }

    public function actionDeleteappoint(){
        $appoint_id = Yii::app()->request->getPost('appoint_id');
        Yii::app()->db->createCommand()
                ->delete("appoint","id = '$appoint_id'");
    }

    public function actionDetailsell($sell_id) {
        //$sell_id = Yii::app()->request->getPost('sell_id');

        $Model = new sell();
        //$sell_id = Yii::app()->request->getPost('sell_id');
        $data['order'] = $Model->Getlistorder($sell_id);
        $data['detail'] = $Model->Detailorder($sell_id);
        $data['logsell'] = Logsell::model()->find("sell_id = '$sell_id' ");
        $this->renderPartial('detailsell', $data);
    }

}
