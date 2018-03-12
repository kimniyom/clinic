<?php

class BonuslevelController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

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
        $model = new Bonuslevel;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Bonuslevel'])) {
            $model->attributes = $_POST['Bonuslevel'];
            if ($model->save())
                $this->redirect(array('index'));
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

        if (isset($_POST['Bonuslevel'])) {
            $model->attributes = $_POST['Bonuslevel'];
            if ($model->save())
                $this->redirect(array('index'));
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
        /*
          $dataProvider=new CActiveDataProvider('Bonuslevel');
          $this->render('index',array(
          'dataProvider'=>$dataProvider,
          ));
         */
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Bonuslevel('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Bonuslevel']))
            $model->attributes = $_GET['Bonuslevel'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Bonuslevel the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Bonuslevel::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Bonuslevel $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bonuslevel-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionCalsalary() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $data['branchlist'] = Branch::model()->findAll();
        } else {
            $data['branchlist'] = Branch::model()->findAll("id=:id", array(":id" => $branch));
        }
        $this->render('calsalary', $data);
    }

    public function actionGetemployee() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $month = Yii::app()->request->getPost('month');
        $branchName = Branch::model()->find("id=:id", array(":id" => $branch))['branchname'];
        $ReportModel = new Report();
        $Income = $ReportModel->GetIncome($year, $branch); //รายได้,คำนวนจากการรักษาการขายสินค้าแต่ละสาขา

        $Emp = Employee::model()->findAll("branch=:branch", array(':branch' => $branch));
        $str = "";
        $str .= "<h4>ยอดร้าน = " . number_format($Income, 2) . " สาขา " . $branchName . " พ.ศ. " . ($year + 543) . " เดือน " . $month . "</h4>";

        foreach ($Emp as $rs):
            $bonus = $this->actionBonus($rs['id'], $Income, $branch);
            $sum = $rs['salary'] + $bonus;
            $str .= "<table class='table table-bordered'><thead><tr><th colspan='2'>";
            $str .= $rs['name'] . " " . $rs['lname'] . " (" . StatusUser::model()->find("id=:id", array(":id" => $rs['status_id']))['status'] . ")";
            $str .= "</th></tr></thead>";
            $str .= "<tbody><tr>";
            $str .= "<td style='width:50%;'>เงินเดือน " . number_format($rs['salary']) . " บาท </td>";
            $str .= "<td>โบนัส " . number_format($bonus) . " บาท</td>";
            $str .= "</tr></tbody>";
            $str .= "<tfoot><tr>";
            $str .= "<th style='text-align:center;'>เหลือรับ</th>";
            $str .= "<th>".number_format($sum)."</th>";
            $str .= "</tr></tfoot>";
            $str .= "</table><br/>";
        endforeach;

        echo $str;
    }

    public function actionBonus($employee, $Income, $branch) {
        $Model = Employee::model()->find("id=:id AND branch=:branch", array(':id' => $employee, ':branch' => $branch));
        $status_id = $Model['status_id'];
        $sql = "select * from bonuslevel where user_status='$status_id' AND branch = '$branch' AND $Income BETWEEN startlevel AND endlevel";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($result['bonus']) {
            return $result['bonus'];
        } else {
            return 0;
        }
    }

}
