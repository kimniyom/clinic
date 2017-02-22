<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">จำนวนOrder</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div id="chartorder" style=" height: 150px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4" style=" text-align: center; color: #ff0000;">
                        <h1><?php echo number_format($countorder['total']) ?></h1>
                        <br/>จำนวนทั้งหมด
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <table class="" style=" width: 100%;">
                            <thead>
                                <tr>
                                    <th>สาขา</th>
                                    <th style=" text-align: center;">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($orderbranch as $orders): $i++
                                    ?>
                                    <tr>
                                        <td><?php echo $orders['branchname'] ?></td>
                                        <td style=" text-align: center;">
                                            <a href="javascript:showordermonth('<?php echo $year ?>','<?php echo $orders['id'] ?>','0')"><?php echo $orders['total'] ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">ยอดขาย</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div id="chartsumorder" style=" height: 150px;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4" style=" text-align: center; color: #ff0000;">
                        <h1><?php echo number_format($datas['pricetotal']) ?></h1><br/>
                        ยอดขายทั้งหมด
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <table class="" style=" width: 100%;">
                            <thead>
                                <tr>
                                    <th>สาขา</th>
                                    <th style=" text-align: center;">จำนวน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($sellorderbranch as $sellprice):
                                    ?>
                                    <tr>
                                        <td><?php echo $sellprice['branchname'] ?></td>
                                        <td style=" text-align: right;">
                                            <a href="javascript:showordermonth('<?php echo $year ?>','<?php echo $sellprice['id'] ?>','1')"><?php echo number_format($sellprice['pricetotal'], 2) ?></a>
                                         </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">จำนวนยอดขายรายเดือน</div>
            <div class="panel-body">
                <div id="chartsumorderall" style=" height: 200px;"></div>
            </div>
            <div class="panel-footer">
                <table class="table table-bordered" style=" width: 100%;" id="ordersumall">
                    <thead>
                        <tr>
                            <th>เดือน</th>
                            <?php
                            foreach ($sumAll as $month):
                                ?>
                                <th><?php echo $month['month_th_shot'] ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>ยอดขาย</b></td>
                            <?php
                            foreach ($sumAll as $month):
                                if ($month['pricetotal'] > 0) {
                                    $color = "color:green;";
                                } else {
                                    $color = "color:red;";
                                }
                                ?>
                                <td style=" text-align: center;<?php echo $color ?>"><?php echo number_format($month['pricetotal']) ?></td>
                            <?php endforeach; ?>
                        </tr>                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 
    POPUP SHOW ORDER
-->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="showordermonth">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">แยกรายเดือน</h4>
      </div>
      <div class="modal-body">
          <div id="resultshowordermonth"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function showordermonth(year, branch,type) {
        var url = "<?php echo Yii::app()->createUrl('reportstorecenter/showordermonth') ?>";
        var data = {year: year, branch: branch,type: type};
        $.post(url, data, function (datas) {
            $("#resultshowordermonth").html(datas);
            $("#showordermonth").modal();
        });
    }
    $(document).ready(function () {
        $("#ordersumall").dataTable({
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
            "bFilter": false, // แสดง search box
            "paging": false,
            "info": false,
            dom: 'Bfrtip',
            buttons: [
                /*
                 'copyHtml5',
                 'excelHtml5',
                 'csvHtml5',
                 'pdfHtml5'
                 */
                {
                    extend: 'copyHtml5',
                    title: 'รายงานยอดขายรายเดือน ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'excelHtml5',
                    title: 'รายงานยอดขายรายเดือน ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'print',
                    title: 'รายงานยอดขายรายเดือน ปี ' + '<?php echo $year ?>'
                }]
        });
        Highcharts.chart('chartorder', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'

            },
            title: {
                text: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    },
                    showInLegend: true
                }
            },
            series: [{
                    name: 'คิดเป็น',
                    colorByPoint: true,
                    data: [<?php echo $valorder ?>]
                }]
        });

        Highcharts.chart('chartsumorder', {
            chart: {
                type: 'column'
            },
            title: {
                text: false
            },
            subtitle: {
                text: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: 0,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 20,
                title: {
                    text: 'จำนวน (บาท)',
                    format: '{value:,.0f}'
                },
                labels: {
                    formatter: function () {
                        return Highcharts.numberFormat(this.value, 0);//this.value;
                    }
                }
            },
            legend: {
                enabled: true
            },
            tooltip: {
                pointFormat: 'ยอดขาย: <b>{point.y:.1f} บาท</b>'
            },
            series: [{
                    name: 'สาขา',
                    colorByPoint: true,
                    data: [<?php echo $valsumorder ?>],
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
                }]
        });

        Highcharts.chart('chartsumorderall', {
            title: {
                text: false
            },
            subtitle: {
                text: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: [<?php echo $catsumorderAll ?>]
            },
            yAxis: {
                title: {
                    text: 'บาท'
                },
                labels: {
                    formatter: function () {
                        return Highcharts.numberFormat(this.value, 0);//this.value;
                    }
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ' บาท'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    color: 'blue',
                    name: 'ยอดขาย',
                    data: [<?php echo $valsumorderAll ?>]
                }]
        });
    });
</script>
