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

    public function actionCalsalary() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $data['branchlist'] = Branch::model()->findAll();
        } else {
            $data['branchlist'] = Branch::model()->findAll("id=:id", array(":id" => $branch));
        }
        $this->render('calsalary', $data);
    }

    public function actionGetemployees() {
        $Lib = new Configweb_model();
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $month = Yii::app()->request->getPost('month');
        $branchName = Branch::model()->find("id=:id", array(":id" => $branch))['branchname'];
        $ReportModel = new Report();
        $Income = $ReportModel->GetIncome($year, $branch); //รายได้,คำนวนจากการรักษาการขายสินค้าแต่ละสาขา
        $Emp = Employee::model()->findAll("branch=:branch", array(':branch' => $branch));

        $checksalary = Salary::model()->find("year=:year and month=:month and branch=:branch", array(":year" => $year, ":month" => $month, ":branch" => $branch));
        if ($checksalary['total']) {
            echo "<a href='" . Yii::app()->createUrl('salary/print', array('year' => $year, 'branch' => $branch, 'month' => $month)) . "' target='_blank' class='btn btn-default'><i class='fa fa-print'></i> พิมพ์</a>";
        } else {
            echo " <button type='button' class='btn btn-success' onclick='confirmsalary()'><i class='fa fa-save'></i> บันทึก</button>";
        }
        $time = " ประจำเดือน " . $Lib->MonthFullArray()[(int) $month] . " พ.ศ. " . ($year + 543);
        $str = "";
        $str .= "<h4>ยอดร้าน = " . number_format($Income, 2) . " สาขา " . $branchName . $time . "</h4>";

        foreach ($Emp as $rs):
            $Agework = $Lib->get_age($rs['walking']);
            if($Agework >= 3){
                $positionsalary = 500;
            } else {
                $positionsalary = 0;
            }
            $bonus = $this->actionBonus($rs['id'], $Income, $branch);
            $commission = $this->actionCommission($rs['id'], $year, $month);
            $sum = $rs['salary'] + $bonus + $commission + $positionsalary;
            $str .= "<table class='table table-bordered'><thead><tr><th colspan='2'>";
            $str .= $rs['name'] . " " . $rs['lname'] . " (" . StatusUser::model()->find("id=:id", array(":id" => $rs['status_id']))['status'] . ") " . $time;
            $str .= "</th></tr></thead>";
            $str .= "<tbody><tr>";
            $str .= "<td style='width:50%;'>เงินเดือน " . number_format($rs['salary']) . " บาท </td>";
            $str .= "<td> โบนัส " . number_format($bonus) . " บาท</td>";
            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td> ค่าตำแหน่ง " . number_format($positionsalary, 2) . " บาท</td>";
            $str .= "<td> คอมมิชชั่น " . number_format($commission, 2) . " บาท</td>";
            $str .= "</tr>";
            $str .= "</tbody>";
            $str .= "<tfoot><tr>";
            $str .= "<th style='text-align:center;'>เหลือรับ</th>";
            $str .= "<th>" . number_format($sum, 2) . " บาท </th>";
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

    public function actionCommission($employee, $year, $month) {
        $sql = "SELECT SUM(result) AS total FROM job WHERE employee = '$employee' AND year = '$year' AND month = '$month'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if ($rs['total']) {
            return $rs['total'];
        } else {
            return 0;
        }
    }

    public function actionPrint($year, $branch, $month) {
        $Lib = new Configweb_model();
        /*
          $year = Yii::app()->request->getPost('year');
          $branch = Yii::app()->request->getPost('branch');
          $month = Yii::app()->request->getPost('month');
         * 
         */
        $branchName = Branch::model()->find("id=:id", array(":id" => $branch))['branchname'];
        $ReportModel = new Report();
        $Income = $ReportModel->GetIncome($year, $branch); //รายได้,คำนวนจากการรักษาการขายสินค้าแต่ละสาขา

        $Emp = Employee::model()->findAll("branch=:branch", array(':branch' => $branch));
        $time = " ประจำเดือน " . $Lib->MonthFullArray()[(int) $month] . " พ.ศ. " . ($year + 543);
        $str = "";
        $str .= "<span style='font-size:24px;'>ยอดร้าน = " . number_format($Income, 2) . " สาขา " . $branchName . $time . "</span>";

        foreach ($Emp as $rs):
            $Agework = $Lib->get_age($rs['walking']);
            if($Agework >= 3){
                $positionsalary = 500;
            } else {
                $positionsalary = 0;
            }
            $bonus = $this->actionBonus($rs['id'], $Income, $branch);
            $commission = $this->actionCommission($rs['id'], $year, $month);
            $sum = $rs['salary'] + $bonus + $commission + $positionsalary;
            $str .= "<table class='table table-bordered'><thead><tr><th colspan='2'>";
            $str .= $rs['name'] . " " . $rs['lname'] . " (" . StatusUser::model()->find("id=:id", array(":id" => $rs['status_id']))['status'] . ") " . $time;
            $str .= "</th></tr></thead>";
            $str .= "<tbody><tr>";
            $str .= "<td style='width:50%;'>เงินเดือน " . number_format($rs['salary']) . " บาท </td>";
            $str .= "<td>โบนัส " . number_format($bonus) . " บาท</td>";
            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td>ค่าตำแหน่ง " . number_format($positionsalary, 2) . " บาท</td>";
            $str .= "<td> คอมมิชชั่น " . number_format($commission, 2) . " บาท</td>";
            $str .= "</tr>";
            $str .= "</tbody>";
            $str .= "<tfoot><tr>";
            $str .= "<th style='text-align:center;'>เหลือรับ</th>";
            $str .= "<th>" . number_format($sum, 2) . " บาท </th>";
            $str .= "</tr></tfoot>";
            $str .= "</table><br/>";
        endforeach;

        $data['time'] = $time;
        $data['table'] = $str;

        # mPDF
        $mPDF1 = Yii::app()->ePdf->mpdf();

        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf($time, 'A4');

        # render (full page)
        //$mPDF1->WriteHTML($this->render('print', $data, true));
        $mPDF1->WriteHTML($this->renderPartial('print', $data, true));
        # Outputs ready PDF
        $mPDF1->Output();
    }

    public function actionConfirmsalarylist() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $month = Yii::app()->request->getPost('month');
        $ReportModel = new Report();
        $Income = $ReportModel->GetIncome($year, $branch); //รายได้,คำนวนจากการรักษาการขายสินค้าแต่ละสาขา

        $Emp = Employee::model()->findAll("branch=:branch", array(':branch' => $branch));
        $sumsalary = 0;
        foreach ($Emp as $rs):
            $bonus = $this->actionBonus($rs['id'], $Income, $branch);
            $commission = $this->actionCommission($rs['id'], $year, $month);
            $sum = $rs['salary'] + $bonus + $commission;
            $sumsalary = $sumsalary + $sum;
            $salary = $rs['salary'];
            $columns = array(
                "employee" => $rs['id'],
                "salary" => $salary,
                "commission" => $commission,
                "total" => $sum,
                "bonus" => $bonus,
                "year" => $year,
                "month" => $month,
                "branch" => $branch,
                "create_date" => date("Y-m-d")
            );
            Yii::app()->db->createCommand()
                    ->insert("salarylist", $columns);
        endforeach;

        //รวมค่าใช้จ่ายเงินเดือนทั้งหมด
        $user = Yii::app()->user->id;
        $columnstotal = array(
            "total" => $sumsalary,
            "year" => $year,
            "month" => $month,
            "branch" => $branch,
            "user" => $user,
            "d_update" => date("Y-m-d")
        );
        Yii::app()->db->createCommand()
                ->insert("salary", $columnstotal);
    }

}
