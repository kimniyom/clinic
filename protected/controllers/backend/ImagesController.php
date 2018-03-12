<?php

class ImagesController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $this->render('//backend/images/index');
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

    public function actionMiniupload() {
        // A list of permitted file extensions
        $allowed = array('jpg', 'jpeg');

        if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
            $Path = Yii::app()->baseUrl . '/uploads/product/';

            $filename = $_FILES["upl"]["name"];
            $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
            $file_ext = substr($filename, strripos($filename, '.')); // get file name
            $newfilename = md5($file_basename) . $file_ext;

            if (!in_array(strtolower($extension), $allowed)) {
                echo 'error';
                exit;
            }

            $columns = array(
                'images' => $newfilename,
                'create_date' => date("Y-m-d")
            );
            Yii::app()->db->createCommand()
                    ->insert("images", $columns);

            $images = $_FILES["upl"]["tmp_name"];
            //copy($_FILES["upl"]["tmp_name"],$Path.$newfilename);
            $width = 1024; //*** Fix Width & Heigh (Autu caculate) ***//
            $size = GetimageSize($images);
            $height = round($width * $size[1] / $size[0]);
            $images_orig = ImageCreateFromJPEG($images);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            ImageJPEG($images_fin, "uploads/product/" . $newfilename);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);

            $this->actionThumbnail($images, $newfilename);
            //if(move_uploaded_file($_FILES['upl']['tmp_name'],$Path.$newfilename)){
            echo 'success';
            exit;
            //}
        }

        echo 'error';
        exit;
    }

    public function actionThumbnail($images, $newfilename) {
        $width = 300; //*** Fix Width & Heigh (Autu caculate) ***//
        $size = GetimageSize($images);
        $height = round($width * $size[1] / $size[0]);
        $images_orig = ImageCreateFromJPEG($images);
        $photoX = ImagesX($images_orig);
        $photoY = ImagesY($images_orig);
        $images_fin = ImageCreateTrueColor($width, $height);
        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
        ImageJPEG($images_fin, "uploads/product/thumbnail/" . $newfilename);
        ImageDestroy($images_orig);
        ImageDestroy($images_fin);
    }

    public function actionLoadimages() {
        $sql = "SELECT * FROM images order by id DESC";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        $data['images'] = $rs;

        $this->renderPartial('//backend/images/loadimages', $data);
    }

    public function actionLoadimagescontrol() {
        $sql = "SELECT * FROM images order by id DESC";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        $data['images'] = $rs;

        $this->renderPartial('//backend/images/loadimagescontrol', $data);
    }

    public function actionDeleteimages() {
        $img = Yii::app()->request->getPost('img');

//$text = 'movies ,  top movies ,watchlist  ,    top song';
        $cut = explode(',', $img);
        foreach ($cut as $single) {
            $id = trim($single);
            $sql = "SELECT * FROM images WHERE id = '$id' ";
            $result = Yii::app()->db->createCommand($sql)->queryRow();
            if (file_exists("uploads/product/" . $result['images'])) {
                unlink("uploads/product/" . $result['images']);
                unlink("uploads/product/thumbnail/" . $result['images']);
            }

            $img_id = $result['id'];
            Yii::app()->db->createCommand()
                    ->delete("product_images", "img_id = '$img_id' ");

            Yii::app()->db->createCommand()
                    ->delete("images", "id = '$img_id' ");
        }
    }

    public function actionDeleteimagesall() {
        $sql = "SELECT * FROM images";
        $results = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($results as $result) {
            if (file_exists("uploads/product/" . $result['images'])) {
                unlink("uploads/product/" . $result['images']);
                unlink("uploads/product/thumbnail/" . $result['images']);
            }

            $img_id = $result['id'];
            Yii::app()->db->createCommand()
                    ->delete("product_images", "img_id = '$img_id' ");

            Yii::app()->db->createCommand()
                    ->delete("images", "id = '$img_id' ");
        }
    }

}
