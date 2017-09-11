
<div class="row" style=" margin: 0px;">
    <div class="col-lg-4">
        <div class="btn  btn-block" style=" border: #33cc00 solid 1px;background: #FFFFFF; color: #33cc00;">
            <h4>รายได้</h4>
            <h3><?php echo number_format($income, 2) ?>  บาท</h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn btn-block" style=" border: #ff0000 solid 1px;background: #FFFFFF; color: #ff0000;">
            <h4>รายจ่าย</h4>
            <h3> <?php echo number_format($outcome, 2) ?> บาท</h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn  btn-block" style=" border: #0000FF solid 1px; background: #FFFFFF; color: #0000FF;">
            <h4>กำไร / ขาดทุน</h4>
            <h3><?php echo number_format($income - $outcome, 2) ?> บาท</h3>
        </div>
    </div>
</div>

<div id="reportperiod"></div>

<div id="reportmonth"></div>

<script type="text/javascript">
    $(function () {
        Highcharts.chart('reportperiod', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ต้นทุน กำไร แยกรายไตรมาส'
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
                        format: '{point.y:.1f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }, {
                    name: 'รายจ่าย',
                    //color: 'blue',
                    data: [<?php echo $outcomeperiod1 ?>, <?php echo $outcomeperiod2 ?>, <?php echo $outcomeperiod3 ?>, <?php echo $outcomeperiod4 ?>]
                    , dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.1f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    });


    $(function () {
        Highcharts.chart('reportmonth', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ต้นทุน กำไร แยกรายเดือน'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo $year + 543 ?>'
            },
            xAxis: {
                categories: [<?php echo $month ?>],
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
                    name: 'ต้นทุน',
                    color: 'green',
                    data: [<?php echo $CostMonth ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.1f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }, {
                    name: 'ยอดขาย',
                    //color: 'blue',
                    data: [<?php echo $SellMonth ?>]
                    , dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.1f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                {
                    name: 'กำไร',
                    type: 'spline',
                    color: 'red',
                    data: [<?php echo $ProfitMonth ?>],
                    tooltip: {
                        valueSuffix: '°C'
                    }
                }]
        });
    });
</script>