<?php

class UserController extends Controller {

    public $layout = "webapp";

    public function actionAddress() {
        $pid = $_POST['pid'];
        $user = new User();
        $data['changwat'] = $user->Get_changwat();
        $data['address'] = $user->Get_address($pid);
        $this->renderPartial("//user/address_user", $data);
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
        $this->renderPartial("//user/edit_address", $data);
    }

    public function actionGet_address_profile() {
        $pid = $_POST['pid'];
        $user = new User();
        $data['changwat'] = $user->Get_changwat();
        $data['address'] = $user->Get_address($pid);
        $this->renderPartial("//user/edit_address_profile", $data);
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

    public function actionDetail() {
        $use = new User();
        $order = new Orders();
        $config = new Configweb_model();

        $pid = Yii::app()->session['pid'];
        $data['user'] = $use->Get_detail($pid);
        $data['order'] = $order->get_order_user($pid);

        //Chart Order Month
        $chart = new Highcharts();
        $Month = $config->MonthShot();
        $categories = implode("','", $Month);
        $order_month = $order->get_order_month($pid);
        foreach ($order_month as $datas):
            $column[] = $datas['PRICE_TOTAL'];
        endforeach;
        $column_value = implode(",", $column);

        $chart->set_id("chart-month");
        $chart->set_type("column");
        $chart->set_title("ข้อมูลการซื้อสินค้าในแต่ละเดือนที่ผ่านมา");
        $year = date("Y");
        $year_now = ($year + 543);
        $chart->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart->set_categories($categories);
        $chart->set_yAxis("จำนวน(บาท)");
        $chart->set_series_name("จำนวน ");
        $chart->set_value($column_value);
        $graph = $chart->Bar_chart();
        $data['chartmonth'] = $graph;

        //Chart Order Month Visit
        $chart_visit = new Highcharts();
        $order_month_vidit = $order->get_order_month_visit($pid);
        foreach ($order_month_vidit as $datavisit):
            $column_visit[] = $datavisit['TOTAL'];
        endforeach;
        $column_visit_value = implode(",", $column_visit);

        $chart_visit->set_id("chart-month-visit");
        $chart_visit->set_type("bar");
        $chart_visit->set_title("ข้อมูลการซื้อสินค้าในแต่ละเดือนที่ผ่านมา(ครั้ง)");
        $chart_visit->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart_visit->set_categories($categories);
        $chart_visit->set_yAxis("จำนวน(ครั้ง)");
        $chart_visit->set_series_name("จำนวน ");
        $chart_visit->set_value($column_visit_value);
        $data['chartvisit'] = $chart_visit->chart_spline();

        //Chart Order type
        $type_model = new Type_product();
        $type = $type_model->Get_all();
        foreach ($type as $Ptype):
            $Ptype_arr[] = $Ptype['type_name'];
        endforeach;
        $categories_type = implode("','", $Ptype_arr);
        $data['categories_type'] = $categories_type;
        $chart_type = new Highcharts();
        $order_type = $order->get_order_type($pid);
        foreach ($order_type as $rs_type):
            $column_type[] = $rs_type['TOTAL'];
        endforeach;
        $column_type_value = implode(",", $column_type);

        $chart_type->set_id("chart-type");
        //$chart_type->set_type("bar");
        $chart_type->set_color("#ffff00");
        $chart_type->set_title("ข้อมูลการซื้อสินค้าแต่ละประเภท");
        $chart_type->set_subtitle("ปี พ.ศ. " . $year_now);
        $chart_type->set_categories($categories_type);
        $chart_type->set_yAxis("จำนวน(บาท)");
        $chart_type->set_series_name("ประเภท ");
        $chart_type->set_value($column_type_value);
        $data['charttype'] = $chart_type->chart_spline();

        $this->render("//user/detail", $data);
    }

    public function actionUpload_profile() {
        $pid = $_POST['pid'];
        $data['pid'] = $pid;
        $this->renderPartial('//user/upload_profile', $data);
    }

    public function actionSave_upload() {
        $configWeb = new Configweb_model();
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
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "file_" . $configWeb->Randstrgen(30) . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $columns = array(
                    "images" => $Name
                );

                Yii::app()->db->createCommand()
                        ->update("masuser", $columns, "pid = '$pid' ");


                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }

        /*
          if (!empty($_FILES)) {
          $tempFile = $_FILES['Filedata']['tmp_name'];
          $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
          $FileName = time() . $_FILES['Filedata']['name'];
          $targetFile = rtrim($targetPath, '/') . '/' . $FileName;

          $fileTypes = array('jpg', 'jpeg', 'png'); // File extensions
          $fileParts = pathinfo($_FILES['Filedata']['name']);

          if (in_array($fileParts['extension'], $fileTypes)) {
          move_uploaded_file($tempFile, $targetFile);

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
         */
    }

    public function actionUploadify() {
        $sql = "SELECT MAX(id) AS maxid FROM project ORDER BY id DESC LIMIT 1";
        $rs = \Yii::$app->db->createCommand($sql)->queryOne();
        $project = $rs['maxid'];
        $targetFolder = Url::base() . '/uploads'; // Relative to the root
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "file_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {

                $columns = array(
                    'file' => $Name,
                    'project' => $project
                );
                Yii::$app->db->createCommand()
                        ->insert("file", $columns)
                        ->execute();

                move_uploaded_file($tempFile, $targetFile);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
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
        $this->renderPartial('//user/update', $data);
    }

}
