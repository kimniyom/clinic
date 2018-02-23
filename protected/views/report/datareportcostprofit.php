<style type="text/css">
    #t-month thead tr th{
        padding: 2px;
    }
    #t-month tbody tr td{
        padding: 2px;
    }
    .well{
        font-size: 24px;
    }

</style>


<div class="row" style=" margin: 0px;">
    <div class="col-md-4 col-lg-4" style=" padding: 0px;">
        <div class="well btn btn-block" style=" border:none; text-align: center;color: #69b829; background: url('<?php echo Yii::app()->baseUrl ?>/images/income-icon.png') #FFFFFF no-repeat bottom right;">
            รายรับ<hr/>
            <?php echo number_format($income, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="well btn btn-block" style="border:none; text-align: center; color: #de1870;  background: url('<?php echo Yii::app()->baseUrl ?>/images/outcome-icon.png') #FFFFFF no-repeat bottom right;">
            รายจ่าย<hr/>
            <?php echo number_format($outcome, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4" style=" padding: 0px;">
        <div class="well btn btn-block" style="border:none; text-align: center; color: #FFFFFF;background: url('<?php echo Yii::app()->baseUrl ?>/images/money-Bag-icon.png') #999999 no-repeat bottom right;">
            กำไร / ขาดทุน<hr/>
            <?php
            $profit = ($income - $outcome);
            if ($profit < 0) {
                echo number_format($profit, 2);
            } else {
                echo "+" . number_format($profit, 2);
            }
            ?>
        </div>
    </div>
</div>

<div class="panel panel-default" style=" margin-top: 10px;">
    <div class="panel-heading" style=" background: none;">รายรับ-รายจ่าย รายไตรมาส</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div id="reportperiod"></div>
            </div>
            <div class="col-md-6 col-lg-6" style="padding-right: 20px;">
                <table class="table table-bordered" style=" margin-top: 20px; border-right: 0px;">
                    <thead>
                        <tr style=" font-weight: bold; background: #cccccc;">
                            <th colspan="4" style=" text-align: center;">รายรับ-รายจ่าย รายไตรมาส ปี พ.ศ. <?php echo $year + 543 ?></th>
                        </tr>
                        <tr style=" font-weight: bold; background: #cccccc;">
                            <th>ไตรมาส</th>
                            <th style=" text-align: center;">รายรับ</th>
                            <th style=" text-align: center;">รายจ่าย</th>
                            <th style=" text-align: center;">กำไร / ขาดทุน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ไตรมาส 1</td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod1, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($outcomeperiod1, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod1 - $outcomeperiod1, 2) ?></td>
                        </tr>
                        <tr>
                            <td>ไตรมาส 2</td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod2, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($outcomeperiod2, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod2 - $outcomeperiod2, 2) ?></td>
                        </tr>
                        <tr>
                            <td>ไตรมาส 3</td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod3, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($outcomeperiod3, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod3 - $outcomeperiod3, 2) ?></td>
                        </tr>
                        <tr>
                            <td>ไตรมาส 4</td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod4, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($outcomeperiod4, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($incomeperiod4 - $outcomeperiod4, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style=" font-weight: bold; background: #cccccc;">
                            <?php
                            $sumincome = ($incomeperiod1 + $incomeperiod2 + $incomeperiod3 + $incomeperiod4);
                            $sumoutcome = ($outcomeperiod1 + $outcomeperiod2 + $outcomeperiod3 + $outcomeperiod4);
                            ?>
                            <td style=" text-align: center;">รวม</td>
                            <td style=" text-align: right;"><?php echo number_format($sumincome, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($sumoutcome, 2) ?></td>
                            <td style=" text-align: right;"><?php echo number_format($sumincome - $sumoutcome, 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" style=" margin-top: 10px; margin-bottom: 0px;">
    <div class="panel-heading" style="background: #FFFFFF;">รายรับ-รายจ่าย รายเดือน</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div id="reportmonth"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                <table class="table table-striped table-bordered" id="t-month">
                    <thead>
                        <tr style=" font-weight: bold; background: #cccccc;">
                            <th style="text-align: center;">เดือน</th>
                            <th style=" text-align: right;">รายรับ</th>
                            <th style=" text-align: right;">รายจ่าย</th>
                            <th style=" text-align: right;">กำไร / ขาดทุน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($masmonth as $m):
                            $mtotal = ($tablemonthIncome[$m['id']] - $tablemonthOutcome[$m['id']]);
                            ?>
                            <tr>
                                <td style=" padding-left: 20px;"><?php echo $m['month_th'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($tablemonthIncome[$m['id']], 2) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($tablemonthOutcome[$m['id']], 2) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($mtotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {
        Highcharts.chart('reportperiod', {
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },

            title: {
                text: 'รายรับ-รายจ่าย รายไตรมาส'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo $year + 543 ?>'
            },
            xAxis: {
                categories: [
                    'ไตรมาส 1',
                    'ไตรมาส 2',
                    'ไตรมาส 3',
                    'ไตรมาส 4'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน (บาท)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} บาท</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'รายรับ',
                    color: 'green',
                    data: [<?php echo $incomeperiod1 ?>, <?php echo $incomeperiod2 ?>, <?php echo $incomeperiod3 ?>, <?php echo $incomeperiod4 ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.2f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }, {
                    name: 'รายจ่าย',
                    color: 'red',
                    data: [<?php echo $outcomeperiod1 ?>, <?php echo $outcomeperiod2 ?>, <?php echo $outcomeperiod3 ?>, <?php echo $outcomeperiod4 ?>]
                    , dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.2f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    });

    /*
     $(function () {
     Highcharts.chart('reportmonths', {
     chart: {
     type: 'column'
     },
     credits: {
     enabled: false
     },
     title: {
     text: 'รายรับ - รายจ่าย แยกรายเดือน'
     },
     subtitle: {
     text: 'ปี พ.ศ. <?php //echo $year + 543     ?>'
     },
     xAxis: {
     categories: [<?php //echo $month     ?>],
     crosshair: true
     },
     yAxis: {
     min: 0,
     title: {
     text: 'จำนวน (บาท)'
     }
     },
     tooltip: {
     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
     '<td style="padding:0"><b>{point.y:.2f} บาท</b></td></tr>',
     footerFormat: '</table>',
     shared: true,
     useHTML: true
     },
     plotOptions: {
     column: {
     pointPadding: 0.2,
     borderWidth: 0
     }
     },
     series: [{
     name: 'รายรับ',
     color: 'green',
     data: [<?php //echo $IncomeMonth     ?>],
     dataLabels: {
     enabled: true,
     rotation: -90,
     color: '#FFFFFF',
     align: 'right',
     format: '{point.y:.2f}', // one decimal
     y: 10, // 10 pixels down from the top
     style: {
     fontSize: '13px',
     fontFamily: 'Verdana, sans-serif'
     }
     }
     
     }, {
     name: 'รายจ่าย',
     color: 'red',
     type: 'line',
     data: [<?php //echo $OutcomeMonth     ?>]
     , dataLabels: {
     enabled: true,
     rotation: -45,
     color: '#FFFFFF',
     align: 'right',
     format: '{point.y:.2f}', // one decimal
     y: 10, // 10 pixels down from the top
     style: {
     fontSize: '13px',
     fontFamily: 'Verdana, sans-serif'
     }
     }
     }]
     });
     });
     */
    $(function () {
        Highcharts.chart('reportmonth', {
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
                categories: [<?php echo $month ?>],
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
                    data: [<?php echo $IncomeMonth ?>]
                }, {
                    type: 'line',
                    color: 'red',
                    name: 'รายจ่าย',
                    data: [<?php echo $OutcomeMonth ?>],
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