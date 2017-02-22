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
        $this->render('formreportincome');
    }

    public function actionReportincome() {
        $year = Yii::app()->request->getPost('year');
        $data['year'] = $year;
        $Model = new ReportStoreCenter();
        $data['datas'] = $Model->GetTotalIncome($year);
        $data['orderbranch'] = $Model->GetSumorderBranch($year);
        $data['countorder'] = $Model->Countorder($year);
        $data['sellorderbranch'] = $Model->Getsumpricebranch($year);
        $data['sumAll'] = $Model->Getsumordermonth($year);
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

        $this->renderPartial('reportincome', $data);
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

    public function actionIncomemonth() {
        
    }

}
