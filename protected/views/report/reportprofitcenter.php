<style type="text/css">
    .well{
        font-size: 24px;
    }

    table thead th{
        white-space: nowrap;
        text-align: center;
    }

    table{
        background: #FFFFFF;
    }

    table tbody tr td{
        text-align: right;
    }
    #tablemonth thead tr th{
        padding: 2px;
    }
    #tablemonth tbody tr td{
        padding: 2px;
    }
</style>

<?php
$Month = Month::model()->findAll();
foreach ($Month as $key) {
    $CategoryArr[] = "'" . $key['month_th'] . "'";
}

$Category = implode(",", $CategoryArr);
?>

<div class="row" style=" margin: 0px;">
    <div class="col-md-4 col-lg-4" style=" padding: 0px;">
        <div class="well btn btn-block" style=" text-align: center;color: #FFFFFF; background: url('<?php echo Yii::app()->baseUrl ?>/images/income-icon.png') #69b829 no-repeat bottom right;">
            รายรับ<hr/>
            <?php echo number_format($income, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="well btn btn-block" style=" text-align: center; color: #FFFFFF;  background: url('<?php echo Yii::app()->baseUrl ?>/images/outcome-icon.png') #de1870 no-repeat bottom right;">
            รายจ่าย<hr/>
            <?php echo number_format($outcome, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4" style=" padding: 0px;">
        <div class="well btn btn-block" style=" text-align: center; color: #FFFFFF;background: url('<?php echo Yii::app()->baseUrl ?>/images/money-Bag-icon.png') #4f8ef7 no-repeat bottom right;">
            กำไร / ขาดทุน<hr/>
            <?php
            $profit = ($income - $outcome);
            if (substr($profit, 0, 1) == "-") {
                echo "-" . number_format($profit, 2);
            } else {
                echo "+" . number_format($profit, 2);
            }
            ?>
        </div>
    </div>
</div>

<div class="panel panel-default" style=" margin-bottom: 0px; ">
    <div class="panel-heading" style=" background: #FFFFFF;">รายงานรายรับ - รายจ่าย</div>
    <div class="panel-body">
        <div class="row" style=" margin: 0px;">
            <div class="col-md-6 col-lg-6">
                <div class="panel-body">
                    <div id="chartprofitmonth"></div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tablemonth">
                        <thead>
                            <tr style=" font-weight: bold; background: #cccccc;">
                                <th style="text-align: center;">#</th>
                                <th style=" text-align: left;">เดือน</th>
                                <th>รายรับ</th>
                                <th>รายจ่าย</th>
                                <th>กำไร / ขาดทุน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumIncome = 0;
                            $sumOutcome = 0;
                            $sumProfit = 0;
                            $i = 0;
                            foreach ($datas as $rs):
                                $sumIncome = $sumIncome + $rs['income'];
                                $sumOutcome = $sumOutcome + $rs['outcome'];
                                $sumProfit = $sumProfit + $rs['profit'];
                                $i++;
                                ?>
                                <tr>
                                    <td style=" text-align: center;"><?php echo $i ?></td>
                                    <td style=" text-align: left;"><?php echo $rs['month_th'] ?></td>
                                    <td><?php echo number_format($rs['income'], 2) ?></td>
                                    <td><?php echo number_format($rs['outcome'], 2) ?></td>
                                    <td><?php echo number_format($rs['profit'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr style=" font-weight: bold; background: #cccccc;">
                                <th style=" text-align: center;font-weight: bold;" colspan="2">รวม</th>
                                <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumIncome, 2) ?></th>
                                <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumOutcome, 2) ?></th>
                                <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumProfit, 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        Highcharts.chart('chartprofitmonth', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'รายรับ - รายจ่าย แยกรายเดือน'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo $year + 543 ?>'
            },
            xAxis: {
                categories: [<?php echo $Category ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน (บาท)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' บาท'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                    color: 'green',
                    name: 'รายรับ',
                    data: [<?php echo $chartincome ?>]
                }, {
                    color: 'red',
                    name: 'รายจ่าย',
                    data: [<?php echo $chartoutcome ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: 0,
                        //color: '#FFFFFF',
                        align: 'right',
                        //format: '{point.y:.2f}', // one decimal
                        y: 10 // 10 pixels down from the top

                    }
                }]
        });
    });
</script>
