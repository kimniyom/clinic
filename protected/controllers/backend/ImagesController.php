<?php

class ImagesController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $banner = new Backend_banner();
        $data['banner'] = $banner->get_banner();
        $this->render('//backend/banner/index', $data);
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

    public function actionUploadify() {
        /*
          Uploadify
          Copyright (c) 2012 Reactive Apps, Ronnie Garcia
          Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
         */

// Define a destination

        $targetFolder = Yii::app()->baseUrl . '/uploads/product'; // Relative to the root
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
            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png'); // File extensions
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
                    'images' => $Name,
                    'create_date' => date("Y-m-d")
                );
                Yii::app()->db->createCommand()
                        ->insert("images", $columns);

                $width = 1280; //*** Fix Width & Heigh (Autu caculate) ***//
                //$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                $size = getimagesize($_FILES['Filedata']['tmp_name']);
                $height = round($width * $size[1] / $size[0]);
                $images_orig = imagecreatefromjpeg($tempFile);
                $photoX = imagesx($images_orig);
                $photoY = imagesy($images_orig);
                $images_fin = imagecreatetruecolor($width, $height);
                imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                imagejpeg($images_fin, "uploads/product/" . $Name);
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
        $sql = "SELECT * FROM images";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        $data['images'] = $rs;

        $this->renderPartial('//backend/images/loadimages', $data);
    }

}
