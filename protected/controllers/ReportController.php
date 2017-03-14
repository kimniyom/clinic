<?php

class ReportController extends Controller {

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
                'actions' => array('create', 'reportinputproductmonth', 'reportcostprofit', 'datareportcostprofit','reportproductsalable','dataproductsalable','reportsellproduct','datareportsellproduct','formreportprofitcenter','reportprofitcenter'),
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

    public function actionReportinputproductmonth() {
        $ReportModel = new Report();
        $data['years'] = Yii::app()->request->getPost('year');
        $data['branch'] = Yii::app()->request->getPost('branch');
        $data['month'] = Month::model()->findAll("");

        $data['product'] = $ReportModel->getproduct($data['branch']);
        $this->render('reportinputproductmonth', $data);
    }

    public function actionReportcostprofit() {
        $this->render('reportcostprofit');
    }

    public function actionDatareportcostprofit() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $ReportModel = new Report();
        $data['Cost'] = $ReportModel->Getcostproduct($year, $branch);
        $data['Sell'] = $ReportModel->Gettotalsell($year, $branch);

        //ต้นทุน กำไรรายไตรมาส
        $data['costperiod1'] = $ReportModel->GetcostproductPeriod($year, $branch, 1)['pricrtotal'];
        $data['costperiod2'] = $ReportModel->GetcostproductPeriod($year, $branch, 2)['pricrtotal'];
        $data['costperiod3'] = $ReportModel->GetcostproductPeriod($year, $branch, 3)['pricrtotal'];
        $data['costperiod4'] = $ReportModel->GetcostproductPeriod($year, $branch, 4)['pricrtotal'];

        $data['sellperiod1'] = $ReportModel->GettotalsellPeriod($year, $branch, 1)['totalprice'];
        $data['sellperiod2'] = $ReportModel->GettotalsellPeriod($year, $branch, 2)['totalprice'];
        $data['sellperiod3'] = $ReportModel->GettotalsellPeriod($year, $branch, 3)['totalprice'];
        $data['sellperiod4'] = $ReportModel->GettotalsellPeriod($year, $branch, 4)['totalprice'];

        //คิดกำไร
        $profit1 = ($data['sellperiod1'] - $data['costperiod1']);
        $profit2 = ($data['sellperiod2'] - $data['costperiod2']);
        $profit3 = ($data['sellperiod3'] - $data['costperiod3']);
        $profit4 = ($data['sellperiod4'] - $data['costperiod4']);
        if ($profit1 < 0)
            $data['profit1'] = 0;
        else
            $data['profit1'] = $profit1;
        if ($profit2 < 0)
            $data['profit2'] = 0;
        else
            $data['profit2'] = $profit2;
        if ($profit3 < 0)
            $data['profit3'] = 0;
        else
            $data['profit3'] = $profit3;
        if ($profit4 < 0)
            $data['profit4'] = 0;
        else
            $data['profit4'] = $profit4;

        //กำไรขาดทุนรายเดือน
        $CostMonth = $ReportModel->GetcostproductMonth($year, $branch);
        $SellMonth = $ReportModel->GettotalsellMonth($year, $branch);
        $ProfitMonth = $ReportModel->GetprofitMonth($year, $branch);
        foreach ($CostMonth as $cm):
            $Month[] = "'" . $cm['month_th'] . "'";
            $CostMonthArr[] = $cm['pricrtotal'];
        endforeach;

        foreach ($SellMonth as $pm):
            $SellMonthArr[] = $pm['totalprice'];
        endforeach;

        foreach ($ProfitMonth as $pf):
            if($pf['profit'] < 0){
                $profit = 0;
            } else {
                $profit = $pf['profit'];
            }
            $ProfitMonthArr[] = $profit;
        endforeach;

        $data['CostMonth'] = implode(",", $CostMonthArr);
        $data['SellMonth'] = implode(",", $SellMonthArr);
        $data['ProfitMonth'] = implode(",", $ProfitMonthArr);
        $data['month'] = implode(",", $Month);
        $data['year'] = $year;
        $this->renderPartial('datareportcostprofit', $data);
    }

     public function actionReportproductsalable() {
        $this->render('reportproductsalable');
    }

    public function actionDataproductsalable(){
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $ReportModel = new Report();
        $ProductSalable = $ReportModel->ProductSalable($year, $branch);
        $catArr = array();
        $valAll = array();
        foreach($ProductSalable as $rs):
            $catArr[] = "'".$rs['product_name']."'";
            $valAll[] = $rs['total'];
        endforeach;

        $data['category'] = implode(",", $catArr);
        $data['value'] = implode(",", $valAll);
        $data['year'] = $year;
        $data['product'] = $ProductSalable;
        $this->renderPartial('dataproductsalable',$data);
    }

    public function actionReportsellproduct() {
        $this->render('reportsellproduct');
    }

    public function actionDatareportsellproduct() {
        $branch = Yii::app()->request->getPost('branch');
        $datestart = Yii::app()->request->getPost('datestart');
        $dateend = Yii::app()->request->getPost('dateend');
        $Model = new Report();
        $data['sell'] = $Model->ReportSellproduct($datestart, $dateend, $branch);
        $this->renderPartial('datareportsellproduct',$data);
    }

    public function actionFormreportprofitcenter(){
        $this->render('formreportprofitcenter');
    }

    public function actionReportprofitcenter(){
        $year = Yii::app()->request->getPost('year');
        $Model = new ReportStoreCenter();
        $data['year'] = $year;
        $data['head'] = "รายงาน กำไร ขาดทุน ปี พ.ศ. " .($year + 543);
        $data['income'] = $Model->GetSumIncome($year)['total'];
        $data['outcome'] = $Model->GetSumOutcome($year)['total'];
        $Chart = $Model->GetchartProfit($year);
        foreach ($Chart as $key) {
            $incomeArr[] = $key['income'];
            $outcomeArr[] = $key['outcome'];
            $profitArr[] = $key['profit'];
        }

        $data['chartincome'] = implode(",", $incomeArr);
        $data['chartoutcome'] = implode(",", $outcomeArr);
        $data['chartprofit'] = implode(",", $profitArr);

        $data['datas'] = $Chart;

        $this->renderPartial('reportprofitcenter',$data);
    }

}
