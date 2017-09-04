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
        $sellmonth = $Model->Getsellmonth($id, $year);

        foreach ($sellmonth as $sm):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $category[] = "['" . $sm['month_th'] . "'," . $sm['total'] . "]";
        endforeach;

        $categorys = implode(",", $category);

        $log = $LogloginModel->Getloglogin($id);
        foreach ($log as $lg):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $loglogin[] = "['" . $lg['month_th'] . "'," . $lg['total'] . "]";
        endforeach;
        $loglogins = implode(",", $loglogin);
        $Selltotalyearnow = $Model->Selltotalyearnow($id);
        $Selltotallastyear = $Model->Selltotallastyear($id);
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'categorys' => $categorys,
            'year' => $year,
            'loglogin' => $loglogins,
            'Selltotalyearnow' => $Selltotalyearnow,
            'Selltotallastyear' => $Selltotallastyear,
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
        if (!$images) {
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
        $configWeb = new Configweb_model();
        $pid = $_GET['pid'];
        $targetFolder = Yii::app()->baseUrl . '/uploads/profile'; // Relative to the root

        $sqlCkeck = "SELECT images FROM employee WHERE pid = '$pid' ";
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
                        ->update("employee", $columns, "pid = '$pid' ");


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
