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
                'actions' => array('create', 'reportinputproductmonth', 'reportcostprofit',
                    'datareportcostprofit', 'reportproductsalable', 'dataproductsalable', 'reportsellproduct',
                    'datareportsellproduct', 'formreportprofitcenter', 'reportprofitcenter', 'reportbranch'),
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
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $data['branchlist'] = Branch::model()->findAll();
        } else {
            $data['branchlist'] = Branch::model()->findAll("id=:id", array(":id" => $branch));
        }
        $this->render('reportcostprofit', $data);
    }

    public function actionDatareportcostprofit() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $ReportModel = new Report();

        $data['Cost'] = $ReportModel->Getcostproduct($year, $branch);
        $data['Sell'] = $ReportModel->Gettotalsell($year, $branch);

        $data['income'] = $ReportModel->GetIncome($year, $branch); //รายได้
        $data['outcome'] = $ReportModel->GetOutcome($year, $branch); //รายจ่าย
        //ต้นทุน กำไรรายไตรมาส
        $data['incomeperiod1'] = $ReportModel->GetIncomePeriod($year, $branch, 1);
        $data['incomeperiod2'] = $ReportModel->GetIncomePeriod($year, $branch, 2);
        $data['incomeperiod3'] = $ReportModel->GetIncomePeriod($year, $branch, 3);
        $data['incomeperiod4'] = $ReportModel->GetIncomePeriod($year, $branch, 4);
        
        $data['outcomeperiod1'] = $ReportModel->GetOutcomePeriod($year, $branch, 1);
        $data['outcomeperiod2'] = $ReportModel->GetOutcomePeriod($year, $branch, 2);
        $data['outcomeperiod3'] = $ReportModel->GetOutcomePeriod($year, $branch, 3);
        $data['outcomeperiod4'] = $ReportModel->GetOutcomePeriod($year, $branch, 4);
        //คิดกำไร
        /*
          $profit1 = ($data['sellperiod1'] - $data['incomeperiod1']);
          $profit2 = ($data['sellperiod2'] - $data['incomeperiod2']);
          $profit3 = ($data['sellperiod3'] - $data['incomeperiod3']);
          $profit4 = ($data['sellperiod4'] - $data['incomeperiod4']);
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
         */
        //กำไรขาดทุนรายเดือน
        $incomeMonth = $ReportModel->GetIncomeMonth($year, $branch);
        $outcomeMonth = $ReportModel->GetOutcomeMonth($year, $branch);
        foreach ($incomeMonth as $cm):
            $Month[] = "'" . $cm['month_th'] . "'";
            $IncomeMonthArr[] = $cm['total'];
        endforeach;

        foreach ($outcomeMonth as $pm):
            $OutcomeMonthArr[] = $pm['total'];
        endforeach;

        $data['IncomeMonth'] = implode(",", $IncomeMonthArr);
        $data['OutcomeMonth'] = implode(",", $OutcomeMonthArr);
        $data['month'] = implode(",", $Month);
        $data['year'] = $year;
        $this->renderPartial('datareportcostprofit', $data);
    }

    public function actionReportproductsalable() {
        $this->render('reportproductsalable');
    }

    public function actionDataproductsalable() {
        $year = Yii::app()->request->getPost('year');
        $branch = Yii::app()->request->getPost('branch');
        $ReportModel = new Report();
        $ProductSalable = $ReportModel->ProductSalable($year, $branch);
        $catArr = array();
        $valAll = array();
        foreach ($ProductSalable as $rs):
            $catArr[] = "'" . $rs['product_name'] . "'";
            $valAll[] = $rs['total'];
        endforeach;

        $data['category'] = implode(",", $catArr);
        $data['value'] = implode(",", $valAll);
        $data['year'] = $year;
        $data['product'] = $ProductSalable;
        $this->renderPartial('dataproductsalable', $data);
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
        $this->renderPartial('datareportsellproduct', $data);
    }

    public function actionFormreportprofitcenter() {
        $this->render('formreportprofitcenter');
    }

    public function actionReportprofitcenter() {
        $year = Yii::app()->request->getPost('year');
        $Model = new ReportStoreCenter();
        $data['year'] = $year;
        $data['head'] = "รายงาน กำไร ขาดทุน ปี พ.ศ. " . ($year + 543);
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

        $this->renderPartial('reportprofitcenter', $data);
    }

    public function actionReportbranch() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $data['branchlist'] = Branch::model()->findAll();
        } else {
            $data['branchlist'] = Branch::model()->findAll("id=:id", array(":id" => $branch));
        }
        $this->render('reportbranch', $data);
    }

}
