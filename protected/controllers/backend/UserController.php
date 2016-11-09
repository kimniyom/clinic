<?php

class UserController extends Controller {

    public $layout = "template_backend";

    public function actionUserall() {
        $use = new User();
        $data['user'] = $use->GetuserAllBranch();

        $this->render("//backend/user/userall", $data);
    }

    public function actionAddress() {
        $pid = $_POST['pid'];
        $user = new User();
        $data['changwat'] = $user->Get_changwat();
        $data['address'] = $user->Get_address($pid);
        $this->renderPartial("//backend/user/address_user", $data);
    }

    public function actionGet_combobox() {
        $type = $_POST['type'];
        $value = $_POST['value'];
        $active = $_POST['active'];
        if ($type === "ampur") {
            $sql = "SELECT * FROM ampur WHERE changwat_id = '$value' ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo $str = "<option value=''>เลือกอำเภอ</option>";
            foreach ($result as $rs):
                $str = "<option value='" . $rs['ampur_id'] . "'";
                if ($rs['ampur_id'] == $active) {
                    $str .= "selected";
                }
                $str .= ">" . $rs['ampur_name'] . "</option>";
                echo $str;
            endforeach;
        } else if ($type === "tambon") {
            $sql = "SELECT * FROM tambon WHERE ampur_id = '$value' ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo $str = "<option value=''>เลือกตำบล</option>";
            foreach ($result as $rs):
                $str = "<option value='" . $rs['tambon_id'] . "'";
                if ($rs['tambon_id'] == $active) {
                    $str .= "selected";
                }
                $str .= ">" . $rs['tambon_name'] . "</option>";

                echo $str;
            endforeach;
        }
    }

    public function actionGet_address() {
        $pid = $_POST['pid'];
        $user = new User();
        $data['changwat'] = $user->Get_changwat();
        $data['address'] = $user->Get_address($pid);
        $this->renderPartial("//backend/user/edit_address", $data);
    }

    public function actionGet_address_profile() {
        $pid = $_POST['pid'];
        $user = new User();
        $data['changwat'] = $user->Get_changwat();
        $data['address'] = $user->Get_address($pid);
        $this->renderPartial("//backend/user/edit_address_profile", $data);
    }

    public function actionSave_address() {
        $pid = $_POST['pid'];
        $user = new User();

        $columns_user = array(
            "name" => $_POST['name'],
            "lname" => $_POST['lname']
        );

        $columns = array(
            "pid" => $_POST['pid'],
            "number" => $_POST['number'],
            "building" => $_POST['building'],
            "class" => $_POST['_class'],
            "room" => $_POST['room'],
            "changwat" => $_POST['changwat'],
            "ampur" => $_POST['ampur'],
            "tambon" => $_POST['tambon'],
            "zipcode" => $_POST['zipcode']
        );
        $check = $user->Check_address($pid);
        if ($check > 0) {
            Yii::app()->db->createCommand()
                    ->update("address", $columns, "pid = '$pid' ");
        } else {
            Yii::app()->db->createCommand()
                    ->insert("address", $columns);
        }

        Yii::app()->db->createCommand()
                ->update("masuser", $columns_user, "pid = '$pid' ");
    }

    public function actionSave_address_profile() {
        $pid = $_POST['pid'];
        $user = new User();

        $columns = array(
            "pid" => $_POST['pid'],
            "number" => $_POST['number'],
            "building" => $_POST['building'],
            "class" => $_POST['_class'],
            "room" => $_POST['room'],
            "changwat" => $_POST['changwat'],
            "ampur" => $_POST['ampur'],
            "tambon" => $_POST['tambon'],
            "zipcode" => $_POST['zipcode']
        );

        $check = $user->Check_address($pid);
        if ($check > 0) {
            Yii::app()->db->createCommand()
                    ->update("address", $columns, "pid = '$pid' ");
        } else {
            Yii::app()->db->createCommand()
                    ->insert("address", $columns);
        }
    }

    public function actionDetail($pid = null) {
        $use = new User();

        $data['user'] = $use->Get_detail($pid);
        $this->render("//backend/user/detail", $data);
    }

    public function actionRegister() {
        $web = new Configweb_model();
        $branchModel = new Branch();
        $data['branch'] = $branchModel->findAll();
        $data['mas_pername'] = $web->pername();
        $data['id'] = $web->autoId('masuser', 'pid', '10');

        $this->render('//user/register', $data);
    }

    public function actionCheck_email($email = null) {
        $sql = "SELECT COUNT(*) AS TOTAL FROM masuser WHERE email = '$email' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    public function actionSave_register() {
        $check_email = $this->actionCheck_email($_POST['email']);
        if ($check_email == '1') {
            $data['id'] = $_POST['pid'];
            $data['error'] = "<i class='fa fa-warning'></i> อีเมล์นี้เคยลงทะเบียนแล้ว ";
            $this->render('register', $data);
        } else {
            if ($_POST['year'] != '' && $_POST['month'] != '' && $_POST['day']) {
                $birth = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            } else {
                $birth = '';
            }
            $columns = array(
                "pid" => $_POST['pid'],
                "alias" => $_POST['alias'],
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "name" => $_POST['name'],
                "lname" => $_POST['lname'],
                "birth" => $birth,
                "sex" => $_POST['sex'],
                "tel" => $_POST['tel'],
                "branch" => $_POST['branch'],
                "login" => $_POST['login'],
                "walking" => $_POST['walking'],
                "create_date" => date("Y-m-d H:i:s"),
                "d_update" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->insert("masuser", $columns);

            $this->redirect(array('backend/user/register_success', 'userID' => $_POST['pid']));
        }
    }

    public function actionRegister_success($userID) {
        $this->render('//user/register_success');
    }

    public function actionSave_edit_profile() {
        $pid = $_POST['pid'];
        if ($_POST['year'] != '' && $_POST['month'] != '' && $_POST['day']) {
            $birth = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
        } else {
            $birth = '';
        }

        $columns = array(
            "alias" => $_POST['alias'],
            "email" => $_POST['email'],
            "name" => $_POST['name'],
            "lname" => $_POST['lname'],
            "birth" => $birth,
            "sex" => $_POST['sex'],
            "tel" => $_POST['tel'],
            "d_update" => date("Y-m-d H:i:s")
        );

        Yii::app()->db->createCommand()
                ->update("masuser", $columns, "pid = '$pid' ");

        $this->redirect(array('backend/user/detail'));
    }

    public function actionUpdate() {
        $use = new User();

        $pid = $_POST['pid'];
        $data['user'] = $use->Get_detail($pid);
        $datas = $data['user'];
        $date = $datas['birth'];
        $data['year'] = substr($date, 0, 4);
        $data['month'] = substr($date, 5, 2);
        $data['day'] = substr($date, 8, 2);
        $data['pid'] = $pid;
        $this->renderPartial('//backend/user/update', $data);
    }
    
    public function actionSave_upload() {
        $pid = $_GET['pid'];
        $targetFolder = Yii::app()->baseUrl . '/uploads/profile'; // Relative to the root

        $sqlCkeck = "SELECT images FROM masuser WHERE pid = '$pid' ";
        $rs = Yii::app()->db->createCommand($sqlCkeck)->queryRow();
        $filename = './uploads/profile/' . $rs['images'];

        if (!file_exists($filename)) {
            unlink('./uploads/profile/' . $rs['images']);
        }

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FileName = time() . $_FILES['Filedata']['name'];
            $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

            $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);

                //สั่งอัพเดท
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
    }

}
