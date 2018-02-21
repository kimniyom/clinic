<?php

class SalaryController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    public function actionIndex() {
        $this->render("index");
    }

    public function actionGetemployee() {
        $branch = Yii::app()->session['branch'];
        $year = Yii::app()->request->getPost('year');
        $month = Yii::app()->request->getPost('month');

        $sql = "SELECT e.* FROM employee e WHERE e.branch = '$branch' AND e.pid NOT IN(
                SELECT employee FROM salarylist WHERE year = '$year' AND month = '$month' AND branch = '$branch')";
        $employee = Yii::app()->db->createCommand($sql)->queryAll();
        $str = "";
        $str .= "<ul class='list-group'>";
        $i = 0;
        foreach ($employee as $rs):
            $i++;
            $str .= "<li class='list-group-item' id='in" . $i . "'>";
            $str .= $rs['name'] . " " . $rs['lname'] . "(" . number_format($rs['salary']) . ")";
            $str .= "<button type='button' class='btn btn-default' onclick=\"selectemployee('" . $i . "', '" . $rs['pid'] . "', '" . $rs['salary'] . "', '" . $rs['name'] . "', '" . $rs['lname'] . "')\" style='position: absolute;right: 3px; top: 3px;'>";
            $str .= "เลือก <i class='fa fa-chevron-right' style='margin: 0px;'></i></button>    </li>";
        endforeach;
        $str .= "</ul>";

        echo $str;
    }

    public function actionSavelist() {
        $ArrPID = Yii::app()->request->getPost('ArrPID');
        $ArrSalary = Yii::app()->request->getPost('ArrSalary');
        $total = Yii::app()->request->getPost('sum');
        $month = Yii::app()->request->getPost('month');
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->session['branch'];
        //บันทึกข้อมูลลงรายการลงตาราง salarylist

        $checkdata = count($ArrSalary);
        for ($i = 0; $i <= $checkdata - 1; $i++):
            $columns = array(
                "employee" => $ArrPID[$i],
                "salary" => $ArrSalary[$i],
                "month" => $month,
                "year" => $year,
                "branch" => $branch
            );

            Yii::app()->db->createCommand()
                    ->insert("salarylist", $columns);
        endfor;

        //บันทึกข้อมูลจำนวนเงินรวม
        $user = Yii::app()->user->id;
        $CheckNull = Salary::model()->find("year = :year AND month = :month AND branch = :branch", array(":year" => $year, ":month" => $month, ":branch" => $branch));

        if (empty($CheckNull)) {
            $columnsSalary = array(
                "user" => $user,
                "total" => $total,
                "month" => $month,
                "year" => $year,
                "branch" => $branch,
                "d_update" => date("Y-m-d")
            );

            Yii::app()->db->createCommand()
                    ->insert("salary", $columnsSalary);
        } else {
            $id = $CheckNull['id'];
            $totalnew = $CheckNull['total'] + $total;
            $columnsSalary = array(
                "total" => $totalnew,
                "d_update" => date("Y-m-d")
            );
            Yii::app()->db->createCommand()
                    ->update("salary", $columnsSalary, "id = '$id'");
        }
    }

}
