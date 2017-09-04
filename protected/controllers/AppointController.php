<?php

class AppointController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'formappoint', 'saveappoint', 
                    'appointover', 'updateappoint', 'appointcurrent', 'appointall', 
                    'getappoint', 'getdayappoint','appointment','appointlist','addeven',
                    'carlendar','carlendarevents','viewcarlendar','deleteappoint','print'),
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
    public function actionCreate() {
        $model = new Appoint;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Appoint'])) {
            $model->attributes = $_POST['Appoint'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
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

        if (isset($_POST['Appoint'])) {
            $model->attributes = $_POST['Appoint'];
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
        $dataProvider = new CActiveDataProvider('Appoint');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Appoint('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Appoint']))
            $model->attributes = $_GET['Appoint'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Appoint the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Appoint::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Appoint $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'appoint-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionFormappoint($seq = null) {
        $data['seq'] = $seq;
        $data['model'] = Appoint::model()->find("service_id = '$seq'");
        $time = $data['model']['timeappoint'];
        $data['hs'] = trim(substr($time, 0, 2));
        $data['ms'] = trim(substr($time, 3, 2));
        $this->renderPartial('formappoint', $data);
    }

    public function actionGetappoint() {
        $branch = Yii::app()->request->getPost('branch');
        $month = Yii::app()->request->getPost('month');
        $years = Yii::app()->request->getPost('year');
        if(!empty($years)){
            $year = $years;
        } else {
            $year = date("Y");
        }
        $sql = "SELECT a.*,SUBSTR(a.appoint,8,2) AS day
                FROM appoint a 
                WHERE SUBSTR(a.appoint,6,2) = '$month' 
                    AND LEFT(a.appoint,4) = '$year' 
                AND a.branch = '$branch' AND a.`status` = '0' ";
        $data['appoint'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('getappoint', $data);
    }

    public function actionGetdayappoint() {
        $branch = Yii::app()->request->getPost('branch');
        $month = Yii::app()->request->getPost('month');
        $day = Yii::app()->request->getPost('day');
        $sql = "SELECT a.*,SUBSTR(a.appoint,6,2) AS m
                FROM appoint a 
                WHERE SUBSTR(a.appoint,6,2) = '$month' 
                    AND SUBSTR(a.appoint,8,2) = '$day' 
                    AND a.branch = '$branch' AND a.`status` = '0' ";
        $appoint = Yii::app()->db->createCommand($sql)->queryAll();
        //$this->renderPartial('getappoint', $data);

        $str = "";
        $str .= '<table class="table table-bordered table-hover">';
        $str .= '<thead>
                <tr>
                    <th style=" width: 5%;">#</th>
                    <th>เวลา</th>
                </tr>
            </thead>
            <tbody> ';
        $i = 0;
        foreach ($appoint as $ap): $i++;
            $str .= '<tr>
                <td style=" text-align: center;">' . $i . '</td>';
            $str .= '<td>' . $ap['timeappoint'] . '</td>
            </tr>';
        endforeach;
        $str .= '</tbody></table>';
        echo $str;
    }

    public function actionSaveappoint() {
        $service_id = Yii::app()->request->getPost('service_id');
        $checkappoint = Appoint::model()->find("service_id = '$service_id' ");
        $id = $checkappoint['id'];
        if (empty($checkappoint['id'])) {
            $columns = array(
                "appoint" => Yii::app()->request->getPost('appoint'),
                "timeappoint" => Yii::app()->request->getPost('time'),
                "service_id" => $service_id,
                "branch" => Yii::app()->request->getPost('branch'),
                "status" => "0",
                "create_date" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->insert("appoint", $columns);
        } else {
            $columns = array(
                "appoint" => Yii::app()->request->getPost('appoint'),
                "timeappoint" => Yii::app()->request->getPost('time'),
                "branch" => Yii::app()->request->getPost('branch'),
//"create_date" => date("Y-m-d H:i:s")
            );

            Yii::app()->db->createCommand()
                    ->update("appoint", $columns, "id = '$id' ");
        }
    }

    public function actionAppointover() {
        $Model = new Appoint();
        $data['appoint'] = $Model->Appointover();
        $this->render('appointover', $data);
    }

    public function actionUpdateappoint() {
        $id = Yii::app()->request->getPost('id');
        $columns = array(
            "appoint" => Yii::app()->request->getPost('appoint'),
            "timeappoint" => Yii::app()->request->getPost('time'),
//"create_date" => date("Y-m-d H:i:s")
        );

        Yii::app()->db->createCommand()
                ->update("appoint", $columns, "id = '$id' ");
    }

    public function actionAppointcurrent() {
        $Model = new Appoint();
        $data['appoints'] = $Model->AppointCurrent();
//print_r($data['appoint']);
        $this->render('appointcurrent', $data);
    }

    public function actionAppointAll() {
        $Model = new Appoint();
        $data['appoints'] = $Model->AppointAll();
//print_r($data['appoint']);
        $this->render('appointall', $data);
    }
    
    public function actionAppointlist() {
        $Model = new Appoint();
        $data['appoint'] = $Model->AppointAll();
//print_r($data['appoint']);
        $this->render('getappoint', $data);
    }

    //โชว์การนัดในสิทธิ์พนักงาน
    public function actionAppointment() {
        $Model = new Appoint();
        $data['appoints'] = $Model->AppointAll();
//print_r($data['appoint']);
        $this->render('appointalluser', $data);
    }
    
    public function actionAddeven(){
        $patient = Yii::app()->request->getPost('patient');
        $appoint = Yii::app()->request->getPost('appoint');
        $type = Yii::app()->request->getPost('type');
        $branch = Yii::app()->request->getPost('branch');
        $etc = Yii::app()->request->getPost('etc');
        $columns = array(
            "appoint" => $appoint,
            "type" => $type,
            "patient_id" => $patient,
            "branch" => $branch,
            "etc" => $etc);
        Yii::app()->db->createCommand()
                ->insert("appoint", $columns);
    }
    
    public function actionCarlendar() {
        $userBranch = Yii::app()->session['branch'];
        if($userBranch == "99"){
            $sql = "SELECT id,branchname FROM branch WHERE id != '99' ";
        } else {
            $sql = "SELECT id,branchname FROM branch WHERE id = '$userBranch' ";
        }
        $data['branch'] = Yii::app()->db->createCommand($sql)->queryAll();
        $this->render('carlendar',$data);
    }

    public function actionCarlendarevents() {
        $branch = Yii::app()->session['branch'];
        if($branch == "99"){
            $WHERE = "";
        } else {
            $WHERE = " AND a.branch = '$branch'";
        }
        $sql = "SELECT a.appoint,a.type,COUNT(*) AS total
                FROM appoint a 
                WHERE a.status = '0' $WHERE
                GROUP BY a.appoint,a.type ";
        $model = Yii::app()->db->createCommand($sql)->queryAll();
        $items = array();
        foreach ($model as $value) {
            if($value['type'] == '1'){
                $color = "green";
                $title = "นัดหัตถการ จำนวน ".$value['total'].' ราย';
            } else if($value['type'] == '2'){
                $color = "blue";
                $title = "นัดพบแพทย์ จำนวน ".$value['total'].' ราย';
            } else {
                $color = "red";
                $title = "ทรีทเม็นท์ จำนวน ".$value['total'].' ราย';
            }
        $items[] = array(
            'id'=>$value['appoint'],
            'title' => $title,
            'type' => $value['type'],
            'start' => $value['appoint'],
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

    public function actionViewcarlendar($appoint = null,$type = null) {
        $Model = new Appoint();
        $data['appoint'] = $Model->Viewcarlendar($appoint, $type);
        $this->renderPartial('viewcarlendar',$data);
    }
    
    public function actionDeleteappoint(){
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("appoint","id = '$id' ");
    }
    
    public function actionPrint($id = null){
        $sql = "SELECT a.*,b.branchname,p.`name`,p.lname,p.birth
                FROM appoint a INNER JOIN branch b ON a.branch = b.id
                INNER JOIN patient p ON a.patient_id = p.id
                WHERE a.id = '$id' ";
        $data['appoint'] = Yii::app()->db->createCommand($sql)->queryRow();
        $this->renderPartial('print',$data);
    }
    
    

}
