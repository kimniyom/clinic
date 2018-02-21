<?php

class RepairController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'carlendar'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'carlendar', 'carlendarevents', 'viewcarlendar', 'addevent', 'deleteevent'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'carlendar'),
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
    public function actionCreate($datealert = null) {
        $model = new Repair;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Repair'])) {
            $model->attributes = $_POST['Repair'];
            $model->user = Yii::app()->user->id;
            $model->d_update = date("Y-m-d");
            $model->branch = Yii::app()->session['branch'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'datealert' => $datealert,
            'model' => $model,
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

        if (isset($_POST['Repair'])) {
            $model->attributes = $_POST['Repair'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
        $this->actionCarlendar();
        /*
          $dataProvider = new CActiveDataProvider('Repair');
          $this->render('index', array(
          'dataProvider' => $dataProvider,
          ));
         * 
         */
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Repair('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Repair']))
            $model->attributes = $_GET['Repair'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Repair the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Repair::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Repair $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'repair-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCarlendar() {
        $model = new Alert();
        $dateRepair = Alert::model()->find(array(
            'limit' => '1'
        ));
        $data['date_repair'] = $dateRepair['alert_repair'];
        $branch = Yii::app()->session['branch'];
        $dateNow = date("Y-m-d");
        if ($branch == "99") {
            $Wbranch = " 1=1";
        } else {
            $Wbranch = " branch = '$branch'";
        }
        $Model = new Repair();
        $data['repair'] = $Model->findAll("$Wbranch AND status = '0' AND date_alert < '$dateNow'");
        $data['alertrepair'] = $model->ListAlertRepair();
        $this->render('carlendar', $data);
    }

    public function actionCarlendarevents() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $WHERE = " 1=1 ";
        } else {
            $WHERE = " a.branch = '$branch'";
        }
        $sql = "SELECT a.date_alert,COUNT(*) AS total
                FROM repair a 
                WHERE $WHERE AND a.status = '0'
                GROUP BY a.date_alert ";
        $model = Yii::app()->db->createCommand($sql)->queryAll();
        $items = array();
        foreach ($model as $value) {
            if ($value['date_alert'] < date("Y-m-d")) {
                $color = "red";
            } else {
                $color = "green";
            }
            $title = "รายการซ่อมบำรุง จำนวน " . $value['total'] . ' รายการ';

            $items[] = array(
                'id' => $value['date_alert'],
                'title' => $title,
                'start' => $value['date_alert'],
                //'end' => date('Y-m-21'),
                //'end' => date('Y-m-d', strtotime('+1 day', strtotime($value->finish))),
                //'time' => date('H:i:s'),
                'color' => $color,
                    //'allDay'=>true,
                    //'url'=>'http://anyurl.com'
            );
        }
        echo CJSON::encode($items);
        Yii::app()->end();
    }

    public function actionViewcarlendar($date = null) {
        $Model = new Repair();
        $data['repair'] = $Model->findAll("date_alert = '$date' AND status = '0'");
        $this->renderPartial('viewcarlendar', $data);
    }

    public function actionAddevent() {
        $id = Yii::app()->request->getPost('id');
        $price = Yii::app()->request->getPost('price');
        $user = Yii::app()->user->id;
        $columns = array("price" => $price, "status" => "1", "d_update" => date('Y-m-d'), "user" => $user);
        Yii::app()->db->createCommand()
                ->update("repair", $columns, "id='$id'");
    }

    public function actionDeleteevent() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("repair", "id='$id'");
    }

}
