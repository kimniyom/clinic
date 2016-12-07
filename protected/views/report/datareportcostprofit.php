<hr/>
<div class="row">
    <div class="col-lg-4">
        <div class="btn btn-success btn-block">
            <h4>ต้นทุนสินค้า</h4>
            <h3><?php echo number_format($Cost['itemstotal']) ?> รายการ <?php echo number_format($Cost['pricetotal']) ?> บาท</h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn btn-primary btn-block">
            <h4>ยอดขายสินค้า</h4>
            <h3><?php echo number_format($Sell['totalitems']) ?> รายการ <?php echo number_format($Sell['totalprice']) ?> บาท</h3>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="btn btn-danger btn-block">
            <h4>กำไร / ขาดทุน</h4>
            <h3><?php echo number_format($Sell['totalprice'] - $Cost['pricetotal']) ?> บาท</h3>
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
                    name: 'ต้นทุน',
                    color: 'green',
                    data: [<?php echo $costperiod1 ?>, <?php echo $costperiod2 ?>, <?php echo $costperiod3 ?>, <?php echo $costperiod4 ?>],
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
                    data: [<?php echo $sellperiod1 ?>, <?php echo $sellperiod2 ?>, <?php echo $sellperiod3 ?>, <?php echo $sellperiod4 ?>]
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
                    data: [<?php echo $profit1 ?>, <?php echo $profit2 ?>, <?php echo $profit3 ?>, <?php echo $profit4 ?>],
                    tooltip: {
                        valueSuffix: '°C'
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