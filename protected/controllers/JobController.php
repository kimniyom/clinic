<?php

class JobController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDelete() {
        $id = Yii::app()->request->getPost('id');
        Yii::app()->db->createCommand()
                ->delete("job", "id='$id'");
    }

    /**
     * Lists all models.
     */
    public function actionIndex($employee) {
        $Model = Employee::model()->find("id=:id", array(":id" => $employee));
        $data['mascommision'] = Mascommision::model()->findAll("user_status=:status_id", array("status_id" => $Model['status_id']));
        $data['employee'] = $Model;
        $this->render("index", $data);
    }

    public function actionCreate() {
        $employee = Yii::app()->request->getPost('employee');
        $commision = Yii::app()->request->getPost('commision');
        $total = Yii::app()->request->getPost('total');
        $result = Yii::app()->request->getPost('result');
        $year = Yii::app()->request->getPost('year');
        $month = Yii::app()->request->getPost('month');
        $columns = array(
            "employee" => $employee,
            "commision" => $commision,
            "total" => $total,
            "result" => $result,
            "year" => $year,
            "month" => $month,
            "create_date" => date("Y-m-d")
        );
        Yii::app()->db->createCommand()
                ->insert("job", $columns);
    }

    public function actionGetjob() {
        $id = Yii::app()->request->getPost('employee');
        $year = Yii::app()->request->getPost('year');
        $month = Yii::app()->request->getPost('month');
        $data['job'] = Job::model()->findAll("employee=:employee AND year=:year AND month=:month", array(":employee" => $id, ":year" => $year, ":month" => $month));
        $this->renderPartial('job', $data);
    }

}
