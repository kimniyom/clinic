<?php

class EmployeeController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    /*
      public function filters() {
      return array(
      'accessControl', // perform access control for CRUD operations
      'postOnly + delete', // we only allow deletion via POST request
      );
      }
     */
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /*
      public function accessRules()
      {
      return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
      'actions'=>array('index','view'),
      'users'=>array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions'=>array('create','update'),
      'users'=>array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions'=>array('admin','delete'),
      'users'=>array('admin'),
      ),
      array('deny',  // deny all users
      'users'=>array('*'),
      ),
      );
      }
     *
     */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $year = date("Y");
        $Model = new Employee();
        $LogloginModel = new Loglogin();
        $commission = $Model->Getcommission($id);
        $category = array();
        foreach ($commission as $sm):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $category[] = "['" . $sm['commisionname'] . "'," . $sm['total'] . "]";
        endforeach;

        $categorys = implode(",", $category);

        $log = $LogloginModel->Getloglogin($id);
        foreach ($log as $lg):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $loglogin[] = "['" . $lg['month_th'] . "'," . $lg['total'] . "]";
        endforeach;
        $loglogins = implode(",", $loglogin);
        //$Selltotalyearnow = $Model->Selltotalyearnow($id);
        //$Selltotallastyear = $Model->Selltotallastyear($id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'categorys' => $categorys,
            'year' => $year,
            'loglogin' => $loglogins,
                //'Selltotalyearnow' => $Selltotalyearnow,
                //'Selltotallastyear' => $Selltotallastyear,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Employee;
        $Config = new Configweb_model();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Employee'])) {
            $model->attributes = $_POST['Employee'];
            $model->pid = $Config->autoId("employee", "pid", 10);
            $model->create_date = date("Y-m-d H:i:s");
            $model->d_update = date("Y-m-d H:i:s");
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

        if (isset($_POST['Employee'])) {
            $model->attributes = $_POST['Employee'];
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
        $images = Employee::model()->find("id = '$id' ")['images'];
        if ($images) {
            unlink("./uploads/profile/" . $images);
        }
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        /*
          if (!isset($_GET['ajax']))
          $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
         *
         */
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $branch = Yii::app()->session['branch'];
        $data['branch'] = $branch;
        if ($branch == "99") {
            $BranchList = Branch::model()->findAll();
        } else {
            $BranchList = Branch::model()->findAll("id = '$branch'");
        }
        $data['BranchList'] = $BranchList;

        $this->render('index', $data);
    }

    public function actionDataemployee() {
        $branch = Yii::app()->request->getPost('branch');
        if ($branch == '99') {
            $data['employee'] = Employee::model()->findAll();
        } else {
            $data['employee'] = Employee::model()->findAll("branch = '$branch' ");
        }
        $data['model'] = Branch::model()->find("id = :id", array(":id" => $branch));
        $this->renderPartial('dataemployee', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Employee('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Employee']))
            $model->attributes = $_GET['Employee'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Employee the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Employee::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Employee $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'employee-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSave_upload() {
        $pid = $_GET['pid'];
        //$Path = Yii::app()->baseUrl . '/uploads/profile/';
        $sqlCkeck = "SELECT images FROM employee WHERE pid = '$pid' ";
        $rs = Yii::app()->db->createCommand($sqlCkeck)->queryRow();
        //$filenames = './uploads/profile/' . $rs['images'];

        if (file_exists($rs['images'])) {
            unlink('./uploads/profile/' . $rs['images']);
        }

// A list of permitted file extensions
        $allowed = array('jpg', 'jpeg');

        if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
            

            $filename = $_FILES["upl"]["name"];
            $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
            $file_ext = substr($filename, strripos($filename, '.')); // get file name
            $newfilename = md5($file_basename) . $file_ext;

            if (!in_array(strtolower($extension), $allowed)) {
                echo 'error';
                exit;
            }

            $columns = array(
                "images" => $newfilename
            );

            Yii::app()->db->createCommand()
                    ->update("employee", $columns, "pid = '$pid' ");

            $images = $_FILES["upl"]["tmp_name"];
            //copy($_FILES["upl"]["tmp_name"],$Path.$newfilename);
            $width = 300; //*** Fix Width & Heigh (Autu caculate) ***//
            $size = GetimageSize($images);
            $height = round($width * $size[1] / $size[0]);
            $images_orig = ImageCreateFromJPEG($images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            ImageJPEG($images_fin, "uploads/profile/" . $newfilename);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);

            //if(move_uploaded_file($_FILES['upl']['tmp_name'],$Path.$newfilename)){
            echo 'success';
            exit;
            //}
        }

        echo 'error';
        exit;
    }

    public function actionCommission() {
        $branch = Yii::app()->session['branch'];
        $data['branch'] = $branch;
        if ($branch == "99") {
            $BranchList = Branch::model()->findAll("id != '99'");
        } else {
            $BranchList = Branch::model()->findAll("id = '$branch'");
        }

        $data['month'] = Month::model()->findAll();
        $data['BranchList'] = $BranchList;

        $this->render('commission', $data);
    }

    public function actionDataemployeecommission() {
        $branch = Yii::app()->request->getPost('branch');
        if ($branch == '99') {
            $data['employee'] = Employee::model()->findAll();
        } else {
            $data['employee'] = Employee::model()->findAll("branch = '$branch' ");
        }
        $data['model'] = Branch::model()->find("id = :id", array(":id" => $branch));
        $this->renderPartial('dataemployeecommission', $data);
    }

}
