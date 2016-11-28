<?php

class LogoController extends Controller {

    public $layout = "template_backend";

    public function actionIndex($branch = null) {
        $model = new Backend_logo();
        $data['branch'] = $branch;
        $data['logo'] = $model->get_logo($branch);
        $this->render('//backend/logo/index', $data);
    }

    public function actionSaveupload($branch = null) {
        // Define a destination
        $targetFolder = Yii::app()->baseUrl . '/uploads/logo'; // Relative to the root
        $sql = "SELECT * FROM logo WHERE branch = '$branch'";
        $row = Yii::app()->db->createCommand($sql)->queryRow();

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                if (empty($row['logo'])) {
                    move_uploaded_file($tempFile, $targetFile);
                    //สั่งอัพเดท
                    $columns = array(
                        "logo" => $FileName,
                        "branch" => $branch,
                        "d_update" => date('Y-m-d H:i:s')
                    );

                    Yii::app()->db->createCommand()
                            ->insert("logo", $columns);
                } else {
                    $filename = './uploads/logo/' . $row['logo'];
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                    move_uploaded_file($tempFile, $targetFile);
                    //สั่งอัพเดท
                    $columns = array(
                        "logo" => $FileName,
                        "d_update" => date('Y-m-d H:i:s')
                    );

                    Yii::app()->db->createCommand()
                            ->update("logo", $columns, "branch = '$branch'");
                }
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionSet_active() {
        $id = $_POST['id'];
        //Clean 
        $columns_clean = array(
            "active" => '0',
            "d_update" => date('Y-m-d H:i:s')
        );
        Yii::app()->db->createCommand()
                ->update("logo", $columns_clean, "1 = 1");

        $columns = array(
            "active" => '1',
            "d_update" => date('Y-m-d H:i:s')
        );
        Yii::app()->db->createCommand()
                ->update("logo", $columns, "id = '$id' ");
    }

    public function actionDelete() {
        $id = $_POST['id'];
        $model = new Backend_logo();
        $rs = $model->get_logo_by_id($id);
        $images = $rs['logo'];
        if (isset($images)) {
            $filename = './uploads/logo/' . $images;

            if (file_exists($filename)) {
                unlink($filename);
            }
        }

        Yii::app()->db->createCommand()
                ->delete('logo', "id = '$id' ");
    }

}
