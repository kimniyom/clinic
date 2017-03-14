<?php

class CameraController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function actionIndex() {
        /*
          $dataProvider = new CActiveDataProvider('Alert');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          ));
         * 
         */

        $this->render('index');
    }

    public function actionNewPhoto() {
        $this->render('newPhoto');
    }

    public function actionSaveJpg($id) {
        echo $id;
        //$this->render('saveJpg');
    }

    /*
      public function actions() {
      return array(
      'jpegcam.' => array(
      'class' => 'application.extensions.jpegcam.EJpegcam',
      'saveJpg' => array(
      'filepath' => Yii::app()->basePath . "/../uploads/user_photo.jpg" // This could be whatever
      )
      )
      );
      }
     * 
     */

    public function actionSaveimage() {
        //set random name for the image, used time() for uniqueness

        $filename = time() . '.jpg';
        $filepath =  "./uploads/saved_images/";

        //read the raw POST data and save the file with file_put_contents()
        $result = file_put_contents($filepath . $filename, file_get_contents('php://input'));
        if (!$result) {
            print "ERROR: Failed to write data to $filename, check permissions\n";
            exit();
        }

        echo $filepath.$filename;
    }

}
