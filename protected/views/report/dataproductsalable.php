
<div id="reportsalable" style=" margin: 0px; width: 95%;"></div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th style=" width: 5%; text-align: center;">#</th>
            <th>สินค้าขายดี</th>
            <th style=" text-align: right;">จำนวน</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0;
        foreach ($product as $rs): $i++; ?>
            <tr>
                <td style="text-align: center;"><?php echo $i ?></td>
                <td><?php echo $rs['product_name'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($rs['total']) ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">

    $(function () {
        Highcharts.chart('reportsalable', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'สินค้าขายดี'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo $year + 543 ?>'
            },
            xAxis: {
                categories: [<?php echo $category ?>],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน (ชิ้น)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} ชิ้น</b></td></tr>',
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
                    name: 'สินค้า',
                    colorByPoint: true,
                    data: [<?php echo $value ?>],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }

                }]
        });
    });
</script>