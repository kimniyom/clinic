<?php

class PatientDrugController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'deletedrug'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'getdrug', 'adddrug', 'deletedrug', 'getpricedrug', 'getdetaildrug', 'saveservicedrug', 'getdetailservicedrug','deletedrugservice'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id) {
        $model = new PatientDrug;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PatientDrug'])) {
            $model->attributes = $_POST['PatientDrug'];
            $model->d_update = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('patientdisease/create', 'id' => $id));
        }

        $this->render('create', array(
            'model' => $model,
            'patient_id' => $id
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PatientDrug'])) {
            $model->attributes = $_POST['PatientDrug'];
            $model->d_update = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
            'patient_id' => $model->patient_id,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('PatientDrug');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PatientDrug('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PatientDrug']))
            $model->attributes = $_GET['PatientDrug'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PatientDrug the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PatientDrug::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PatientDrug $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'patient-drug-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetdrug() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $data['patientdrug'] = PatientDrug::model()->findAll("patient_id = '$patient_id' ");

        $this->renderPartial('getdrug', $data);
    }

    public function actionAdddrug() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $drug = Yii::app()->request->getPost('drug');
        $columns = array("patient_id" => $patient_id, "drug" => $drug, "d_update" => date("Y-m-d H:i:s"));
        Yii::app()->db->createCommand()
                ->insert("patient_drug", $columns);
    }

    public function actionDeletedrug() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("patient_drug", "id = '$id' ");
    }

    public function actionSqlproduct($product_id) {
        $branch = Yii::app()->session['branch'];
        $sql = "SELECT s.*,c.product_nameclinic AS nameclinic,c.product_detail AS detail,u.unit AS unitname
                    FROM clinic_stockproduct s INNER JOIN  center_stockproduct  c ON s.product_id = c.product_id
                    INNER JOIN unit u ON s.unit = u.id
                    WHERE s.branch = '$branch' AND s.product_id = '$product_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    public function actionGetpricedrug() {
        $product_id = Yii::app()->request->getPost('productid');
        $rs = $this->actionSqlproduct($product_id);
        if ($rs['price_promotion'] == "") {
            $price = $rs['product_price'];
        } else {
            $price = $rs['price_promotion'];
        }
        $Json = array("price" => $price, "unit" => $rs['unitname']);
        echo json_encode($Json);
    }

    public function actionGetdetaildrug() {
        $product_id = Yii::app()->request->getPost('productid');
        $rs = $this->actionSqlproduct($product_id);
        echo $rs['detail'];
        if ($rs['price_promotion'] == "") {
            echo "<b>ราคา " . $rs['product_price'] . " บาท</b>";
        } else {
            echo "<b>ราคา <del style='color:red;'>" . $rs['product_price'] . "</del> บาท";
            echo "ราคาโปรโมชั่น " . $rs['price_promotion'] . " บาท</b>";
        }
    }

    public function actionSaveservicedrug() {
        $patient_id = Yii::app()->request->getPost('patient_id');
        $drug = Yii::app()->request->getPost('drug');
        $number = Yii::app()->request->getPost('number');
        $price = Yii::app()->request->getPost('price');
        $service_id = Yii::app()->request->getPost('service_id');
        $total = Yii::app()->request->getPost('total');
        $doctor = Yii::app()->user->id;

        $columns = array(
            "patient_id" => $patient_id,
            "drug" => $drug,
            "number" => $number,
            "price" => $price,
            "service_id" => $service_id,
            "total" => $total,
            "doctor" => $doctor,
            "date_serv" => date("Y-m-d H:i:s")
        );
        Yii::app()->db->createCommand()
                ->insert("service_drug", $columns);
    }

    public function actionGetdetailservicedrug($service_id) {
        $sql = "SELECT s.*,u.unit AS unitname,c.product_nameclinic,c.product_name AS productname
                FROM service_drug s INNER JOIN clinic_stockproduct st ON s.drug = st.product_id
                INNER JOIN unit u ON st.unit = u.id
                INNER JOIN center_stockproduct c ON s.drug = c.product_id
                WHERE service_id = '$service_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $grid = "<table style='width:100%;' class='table table-striped'>
                <thead>
                    <tr>
                        <th>รหัสยา</th>
                        <th>ชื่อยา</th>
                        <th style='text-align:center;'>จำนวน</th>
                        <th style='text-align:center;'></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";
        foreach ($result as $row):
            $grid .= "<tr>
                        <td style='padding:3px;'>" . $row['drug'] . "</td>
                        <td style='padding:3px;'>" . $row['product_nameclinic'] . "</td>
                        <td style='padding:3px;text-align:center;'>" . number_format($row['number']) . "</td>
                        <td style='padding:3px;'>".$row['unitname']."</td>
                        <td style='padding:3px;text-align:center;'>
                            <a href='javascript:deletedrugservice(" . $row['id'] . ")'><i class='fa fa-trash text-danger'></i></a>
                        </td>
                    </tr>";
        endforeach;
        $grid .="</tbody></table>";

        echo $grid;
    }

    public function actionDeletedrugservice() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("service_drug", "id = $id");
    }

}
