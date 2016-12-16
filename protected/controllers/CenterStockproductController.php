<?php

class CenterStockproductController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $data['product'] = CenterStockproduct::model()->findAll('');
        $this->render('index', $data);
    }

    /*
      public function actionGetproduct() {
      $type_id = $_GET['type_id'];
      $product = new Backend_product();
      $data['model'] = $product;
      $data['type_id'] = $type_id;
      $data['type_name'] = $product->get_type_name($type_id);
      $data['product'] = $product->get_product_all($type_id);

      $data['count_product_type'] = $product->get_count_product_type($type_id);

      $this->render("//backend/product/show_product_all", $data);
      }
     * 
     */

    public function actionCreate() {
        Yii::app()->db->createCommand()->delete("product_images", "product_id = '' ");
        $data['producttype'] = ProductType::model()->findAll('');
        $this->render("create", $data);
    }

    public function actionSave_product() {
        $data = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_detail' => $_POST['product_detail'],
            'product_price' => $_POST['product_price'],
            'costs' => $_POST['costs'],
            'type_id' => $_POST['type_id'],
            //'branch' => $_POST['branch'],
            'd_update' => date('Y-m-d H:i:s')
        );

        Yii::app()->db->createCommand()
                ->insert('centerstockproduct', $data);

        //echo $this->redirect(array('backend/product/detail_product&product_id=' . $_POST['product_id']));
    }

    public function actionUpdate() {
        $type_id = $_GET['type_id'];
        $product_id = $_GET['product_id'];
        $product = new Backend_product();

        $data['product'] = $product->_get_detail_product($product_id);
        $data['type_id'] = $type_id;
        $data['type_name'] = $product->get_type_name($type_id);

        $this->render("//backend/product/update", $data);
    }

    public function actionSave_update() {
        $product_id = $_POST['product_id'];
        $data = array(
            'product_name' => $_POST['product_name'],
            'product_detail' => $_POST['product_detail'],
            'product_price' => $_POST['product_price'],
            'costs' => $_POST['costs'],
            'branch' => $_POST['branch'],
            'd_update' => date('Y-m-d H:i:s')
        );

        Yii::app()->db->createCommand()
                ->update('product', $data, "product_id = '$product_id'");
    }

    public function actionDetail($product_id = null) {
        //$product_id = $_GET['product_id'];

        $product = new Backend_product();
        $Model = new CenterStockproduct();
        //$Items = new Items();

        $data['images'] = $product->get_images_product($product_id);
        $data['product'] = $Model->_get_detail_product($product_id);
        //$data['items'] = $Items->GetItem($product_id);
        //$data['near'] = $product->get_product_near($product_id);

        $this->render("detailt", $data);
    }

    public function actionImages() {
        $product_id = $_GET['product_id'];

        $product = new Backend_product();
        $data['product'] = $product->_get_detail_product($product_id);
        $data['imgtitle'] = $product->get_images_product_title($product_id);
        $this->render("//backend/product/images", $data);
    }

    public function actionGet_images() {
        $product_id = $_POST['product_id'];
        $product = new Backend_product();
        $data['images'] = $product->get_images_product($product_id);
        $this->renderPartial("//backend/product/getimages", $data);
    }

    public function actionInsertimages() {
        $product = Yii::app()->request->getPost('product_id');
        $img = Yii::app()->request->getPost('img');

        //$text = 'movies ,  top movies ,watchlist  ,    top song';
        $cut = explode(',', $img);
        foreach ($cut as $single) {
            $columns = array("product_id" => $product, "images" => trim($single));
            Yii::app()->db->createCommand()
                    ->insert("product_images", $columns);
        }
    }

    public function actionUpload() {
        // Define a destination
        $product_id = $_GET['product_id'];
        $targetFolder = Yii::app()->baseUrl . '/uploads'; // Relative to the root

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

                //สั่งอัพเดท
                $columns = array(
                    "product_id" => $product_id,
                    "images" => $FileName
                );

                Yii::app()->db->createCommand()
                        ->insert("product_images", $columns);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionDelete_images() {
        $id = $_POST['id'];
        $product_id = $_POST['product_id'];

        Yii::app()->db->createCommand()
                ->delete('product_images', "id = '$id' AND product_id = '$product_id' ");
    }

    public function actionSet_active() {
        $product_id = $_POST['product_id'];
        $columns = array("status" => $_POST['status']);
        Yii::app()->db->createCommand()
                ->update("product", $columns, "product_id = '$product_id' ");
    }

    public function actionImages_title() {
        $product = new Product();
        $product_id = $_GET['product_id'];
        $type_id = $_GET['type_id'];

        $data['product'] = $product->_get_detail_product($product_id);
        $data['type_id'] = $type_id;
        $data['type_name'] = $product->get_type_name($type_id);

        $this->render('//backend/product/images_title', $data);
    }

    public function actionImg_save_to_file() {
        //$imagePath = "temp/";
        $imagePath = 'uploads/product/'; // Relative to the root
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        $temp = explode(".", $_FILES["img"]["name"]);
        $extension = end($temp);

        //Check write Access to Directory

        if (!is_writable($imagePath)) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t upload File; no write Access'
            );
            print json_encode($response);
            return;
        }

        if (in_array($extension, $allowedExts)) {
            if ($_FILES["img"]["error"] > 0) {
                $response = array(
                    "status" => 'error',
                    "message" => 'ERROR Return Code: ' . $_FILES["img"]["error"],
                );
            } else {

                $filename = $_FILES["img"]["tmp_name"];
                list($width, $height) = getimagesize($filename);

                move_uploaded_file($filename, $imagePath . $_FILES["img"]["name"]);

                $response = array(
                    "status" => 'success',
                    "url" => $imagePath . $_FILES["img"]["name"],
                    "width" => $width,
                    "height" => $height
                );
            }
        } else {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
            );
        }

        print json_encode($response);
    }

    public function actionImg_crop_to_file() {
        $product_id = $_GET['product_id'];
        $query = "SELECT * FROM product_images WHERE product_id = '$product_id' AND active = '1'";
        $check = Yii::app()->db->createCommand($query)->queryRow();

        $imgUrl = $_POST['imgUrl'];
// original sizes
        $imgInitW = $_POST['imgInitW'];
        $imgInitH = $_POST['imgInitH'];
// resized sizes
        $imgW = $_POST['imgW'];
        $imgH = $_POST['imgH'];
// offsets
        $imgY1 = $_POST['imgY1'];
        $imgX1 = $_POST['imgX1'];
// crop box
        $cropW = $_POST['cropW'];
        $cropH = $_POST['cropH'];
// rotation angle
        $angle = $_POST['rotation'];

        $jpeg_quality = 100;

        $New_filename = "croppedImg_" . rand();
        $output_filename = "uploads/product_thumb/" . $New_filename;

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

        $what = getimagesize($imgUrl);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default: die('image type not supported');
        }


//Check write Access to Directory

        if (!is_writable(dirname($output_filename))) {
            $response = Array(
                "status" => 'error',
                "message" => 'Can`t write cropped File'
            );
        } else {

            // resize the original image to size of editor
            $resizedImage = imagecreatetruecolor($imgW, $imgH);
            imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
            // rotate the rezized image
            $rotated_image = imagerotate($resizedImage, -$angle, 0);
            // find new width & height of rotated image
            $rotated_width = imagesx($rotated_image);
            $rotated_height = imagesy($rotated_image);
            // diff between rotated & original sizes
            $dx = $rotated_width - $imgW;
            $dy = $rotated_height - $imgH;
            // crop rotated image to fit into original rezized rectangle
            $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
            imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
            imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
            // crop image into selected area
            $final_image = imagecreatetruecolor($cropW, $cropH);
            imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
            imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
            // finally output png image
            //imagepng($final_image, $output_filename.$type, $png_quality);
            imagejpeg($final_image, $output_filename . $type, $jpeg_quality);
            $response = Array(
                "status" => 'success',
                "url" => $output_filename . $type
            );
        }
        //$filename = './uploads/' . $images;
        //unlink($what);
        $files = glob("uploads/product/*");
        foreach ($files as $file) {
            unlink("./" . $file);
        }

        //Check To File
        if (!empty($check)) {
            unlink("./uploads/product_thumb/" . $check['images']);
            $columns = array("images" => $New_filename . $type);
            Yii::app()->db->createCommand()
                    ->update("product_images", $columns, "product_id = '$product_id' AND active = '1'");
        } else {
            $columns = array("product_id" => $product_id, "active" => '1', "images" => $New_filename . $type);
            Yii::app()->db->createCommand()
                    ->insert("product_images", $columns);
        }

        print json_encode($response);
    }

}
