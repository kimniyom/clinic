<?php
class BannerController extends Controller{
	public $layout = "template_backend";

	public function actionIndex(){
		$banner = new Backend_banner();
        $data['banner'] = $banner->get_banner();
        $this->render('//backend/banner/index',$data);
	}

	public function actionSaveupload(){
        // Define a destination
        $targetFolder = Yii::app()->baseUrl . '/uploads/banner'; // Relative to the root

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

                //สั่งอัพเดท
                $columns = array(
                    "banner_images" => $FileName
                );

                Yii::app()->db->createCommand()
                        ->insert("banner", $columns);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionSet_active(){
        $banner_id = $_POST['banner_id'];
        $status = $_POST['status'];

        $columns = array("status" => $status);

        Yii::app()->db->createCommand()
            ->update("banner",$columns,"banner_id = '$banner_id' ");
    }

    public function actionDelete(){
        $banner_id = $_POST['banner_id'];
        $model = new Backend_banner();
        $rs = $model->get_banner_by_id($banner_id);
        $images = $rs['banner_images'];
        if (isset($images)) {
            $filename = './uploads/banner/' . $images;

            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        Yii::app()->db->createCommand()
                ->delete('banner', "banner_id = '$banner_id' ");
    }
}