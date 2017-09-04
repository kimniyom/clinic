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

    public function actionSaveimage($service_id) {
        //set random name for the image, used time() for uniqueness

        $filename = time() . '.jpg';
        $filepath = "./uploads/saved_images/";

        //read the raw POST data and save the file with file_put_contents()
        $result = file_put_contents($filepath . $filename, file_get_contents('php://input'));
        if (!$result) {
            print "ERROR: Failed to write data to $filename, check permissions\n";
            exit();
        }
        $columns = array(
            "images" => $filename,
            "service_id" => $service_id
        );
        Yii::app()->db->createCommand()
                ->insert("service_images", $columns);
        echo $filepath . $filename;
    }

    public function actionLoadimages() {
        $service_id = Yii::app()->request->getPost('service_id');
        $sql = "SELECT * FROM service_images WHERE service_id = '$service_id' ";
        $data['images'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('loadimages', $data);
    }

    public function actionDeleteimages() {
        $id = Yii::app()->request->getPost('id');
        $sql = "SELECT * FROM service_images WHERE id = '$id'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if ($rs['images']) {
            if (file_exists("./uploads/saved_images/" . $rs['images'])) {
                unlink("./uploads/saved_images/" . $rs['images']);
            }
            Yii::app()->db->createCommand()
                    ->delete("service_images", "id = '$id'");
        }
    }

}
