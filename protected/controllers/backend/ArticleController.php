<?php

class ArticleController extends Controller {

    public $layout = "template_backend";

    public function actionIndex() {
        $art = new Backend_article();
        $data['article'] = $art->Get_article_all();
        $this->render("//backend/article/index", $data);
    }

    public function actionCreate() {
        $sql = "SELECT MAX(id) AS id FROM article ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        $data['id'] = ($rs['id'] + 1);
        $this->render("//backend/article/create", $data);
    }

    public function actionSave() {
        $columns = array(
            "title" => $_POST['title'],
            "detail" => $_POST['msg'],
            "owner" => Yii::app()->session['pid'],
            "create_date" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("article", $columns);
    }

    public function actionUpload() {
        // Define a destination
        $id = $_GET['id'];

        //Check File 
        $art = new Backend_article();
        $rs = $art->Get_article_by_id($id);
        if (!empty($rs['images'])) {
            $filename = './uploads/article/' . $rs['images'];

            if (file_exists($filename)) {
                unlink($filename);
            }
        }
        
        $targetFolder = Yii::app()->baseUrl . '/uploads/article'; // Relative to the root

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
                    "images" => $FileName
                );

                Yii::app()->db->createCommand()
                        ->update("article", $columns, "id = '$id' ");
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionUpdate() {
        $id = $_GET['id'];
        $art = new Backend_article();
        $data['rs'] = $art->Get_article_by_id($id);
        $this->render("//backend/article/update", $data);
    }

    public function actionSave_update() {
        $id = $_POST['id'];
        $columns = array(
            "title" => $_POST['title'],
            "detail" => $_POST['msg'],
            "owner" => Yii::app()->session['pid']
        );
        Yii::app()->db->createCommand()
                ->update("article", $columns, "id = '$id'");
    }

    public function actionView() {
        $id = $_GET['id'];
        $article = new Backend_article();
        $data['result'] = $article->Get_article_by_id($id);
        $this->render("//backend/article/view", $data);
    }
    
    public function actionDelete(){
        //Check File 
        $id = $_POST['id'];
        $art = new Backend_article();
        $rs = $art->Get_article_by_id($id);
        if (!empty($rs['images'])) {
            $filename = './uploads/article/' . $rs['images'];

            if (file_exists($filename)) {
                unlink($filename);
            }
        }
        
        Yii::app()->db->createCommand()
                ->delete("article","id = '$id' ");
    }

}
