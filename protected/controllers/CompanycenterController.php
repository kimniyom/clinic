<?php

class CompanycenterController extends Controller {

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
                'actions' => array('create', 'update', 'upload'),
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
        $model = new Companycenter;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Companycenter'])) {
            $model->attributes = $_POST['Companycenter'];
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

        if (isset($_POST['Companycenter'])) {
            $model->attributes = $_POST['Companycenter'];
            if ($model->save())
                $this->redirect(Yii::app()->createUrl('store/index'));
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
        $dataProvider = new CActiveDataProvider('Companycenter');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Companycenter('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Companycenter']))
            $model->attributes = $_GET['Companycenter'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Companycenter the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Companycenter::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Companycenter $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'companycenter-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUpload() {
        // Define a destination
        $targetFolder = Yii::app()->baseUrl . '/uploads/logo'; // Relative to the root
        $sql = "SELECT * FROM companycenter LIMIT 1";
        $row = Yii::app()->db->createCommand($sql)->queryRow();

        

        if (file_exists('./uploads/logo/'.$row['logo'])) {
            unlink('./uploads/logo/' . $row['logo']);
        }

// A list of permitted file extensions
        $allowed = array('jpg', 'jpeg','png','gif');

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


           


            $images = $_FILES["upl"]["tmp_name"];
            //copy($_FILES["upl"]["tmp_name"],$Path.$newfilename);
            /*
            $width = 300; 
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
            */
            //copy($_FILES["upl"]["tmp_name"],"./uploads/logo/".$newfilename);
            
            
            if(move_uploaded_file($_FILES["upl"]["tmp_name"],"./uploads/logo/".$newfilename)){
                 $columns = array(
                    "logo" => $newfilename
                );

                Yii::app()->db->createCommand()
                        ->update("companycenter", $columns, "id = '1'");
            echo 'success';
            exit;
            }
            
        }

        echo 'error';
        exit;
    }

}
