<?php

class ReportstorecenterController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_report';

    public function actionIndex() {
        
    }

    public function actionFormreportincome() {
        $this->layout = 'template_backend';
        $this->render('formreportincome');
    }

    public function actionReportincome() {
        $year = Yii::app()->request->getPost('year');
        $data['year'] = $year;
        $Model = new ReportStoreCenter();
        $data['datas'] = $Model->GetTotalIncome($year); //ยอดรวม
        $data['orderbranch'] = $Model->GetSumorderBranch($year); //จำนวนออเด้อแต่ละสาขา
        $data['countorder'] = $Model->Countorder($year); //ออเด้อทั้งหมด
        $data['sellorderbranch'] = $Model->Getsumpricebranch($year); //ยอดซื้อแต่ละสาขา
        $data['sumAll'] = $Model->Getsumordermonth($year); //ยอดซื้อรวมในแต่ละเดือน
        //chart sumorder
        foreach ($data['orderbranch'] as $rs):
            $valoder[] = "{name: '" . $rs['branchname'] . "',y: " . $rs['total'] . "}";
        endforeach;
        $data['valorder'] = implode($valoder, ",");

        //chart sumprice
        foreach ($data['sellorderbranch'] as $rss):
            //$valsumorder[] = "{name: '".$rss['branchname']."',y: ".$rss['pricetotal']."}";
            $valsumorder[] = "['" . $rss['branchname'] . "', " . $rss['pricetotal'] . "]";
        endforeach;
        $data['valsumorder'] = implode($valsumorder, ",");

        //chart sumall
        foreach ($data['sumAll'] as $sumall):
            $cat[] = "'" . $sumall['month_th'] . "'";
            $val[] = $sumall['pricetotal'];
            //$valsumorderAll[] = "['" . $sumall['month_th'] . "', " . $sumall['pricetotal'] . "]";
        endforeach;
        $data['catsumorderAll'] = implode($cat, ",");
        $data['valsumorderAll'] = implode($val, ",");

        $branch = Branch::model()->findAll("id != '99'");
        foreach ($branch as $b):
            $Arr[] = $this->Getval($year, $b['id']);
        endforeach;
        $data['chartline'] = implode($Arr, ",");
        $this->renderPartial('reportincome', $data);
    }

    function Getval($year, $branch) {
        $brancName = Branch::model()->find("id = '$branch'")['branchname'];
        $Model = new ReportStoreCenter();
        $resultbranch = $Model->Getsumordermonthbranch($year, $branch);
        foreach ($resultbranch as $rs):
            $varbranch[] = $rs['pricetotal'];
        endforeach;
        $varlue = implode($varbranch, ",");
        $result = "{ name: '$brancName',data: [$varlue] }";
        return $result;
    }

    public function actionShowordermonth() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $type = Yii::app()->request->getPost('type');
        $Model = new ReportStoreCenter();
        if ($type == '0') {
            $data['datas'] = $Model->GetordermonthInyear($year, $branch);
        } else {
            $data['datas'] = $Model->GetordermonthPriceInyear($year, $branch);
        }
        $this->renderPartial('showordermonth', $data);
    }

    public function actionFormreportinputitems() {
        $this->layout = 'template_backend';
        $this->render('formreportinputitems');
    }

    public function actionReportinputitemsperiod() {
        $year = Yii::app()->request->getPost('year');
        $Model = new ReportStoreCenter();
        $data['tables'] = $Model->ReportInputItemPeriod($year);
        $data['itemsprice'] = $Model->ReportInputItemPeriodPrice($year);
        $data['year'] = $year;
        $this->renderPartial('reportinputitemsperiod', $data);
    }

    public function actionReportinputitemsmonth() {
        $year = Yii::app()->request->getPost('year');
        $Model = new ReportStoreCenter();
        $data['tables'] = $Model->ReportInputItemMonth($year);
        $data['itemsprice'] = $Model->ReportInputItemMonthPrice($year);
        $data['year'] = $year;
        $this->renderPartial('reportinputitemsmonth', $data);
    }

}
