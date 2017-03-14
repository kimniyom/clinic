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
</style>

<?php
$Month = Month::model()->findAll();
foreach ($Month as $key) {
    $CategoryArr[] = "'" . $key['month_th'] . "'";
}

$Category = implode(",", $CategoryArr);

?>

<hr/>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="well btn btn-block" style=" text-align: center; color: #66cc00;">
            รายรับ<hr/>
            <?php echo number_format($income, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="well btn btn-block" style=" text-align: center; color: #ff3300;">
            รายจ่าย<hr/>
            <?php echo number_format($outcome, 2) ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="well btn btn-block" style=" text-align: center; color: #003399;">
            กำไร / ขาดทุน<hr/>
            <?php
            $profit = ($income - $outcome);
            if (substr($profit, 0, 1) == "-") {
                echo '<fonth style="color:red;">' . number_format($profit, 2) . '</fonth>';
            } else {
                echo "<fonth style='color:green;'>+" . number_format($profit, 2) . "</fonth>";
            }
            ?>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div id="chartprofitmonth"></div>
    </div>
    <div class="panel-footer">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablemonth">
                <thead>
                    <tr>
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
                    $i=0;
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
                    <tr>
                        <th style=" text-align: center;font-weight: bold;" colspan="2">รวม</th>
                        <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumIncome,2) ?></th>
                        <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumOutcome,2) ?></th>
                        <th style=" text-align: right;font-weight: bold;"><?php echo number_format($sumProfit,2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#tablemonth").dataTable({
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
                    title: 'รายงาน กำไร ขาดทุน ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'excelHtml5',
                    title: 'รายงาน กำไร ขาดทุน ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'print',
                    title: 'รายงาน กำไร ขาดทุน ปี ' + '<?php echo $year ?>'
                }]
        });
        Highcharts.chart('chartprofitmonth', {
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $head ?>'
            },
            xAxis: {
                categories: [<?php echo $Category ?>]
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'รายรับ',
                    color: 'green',
                    data: [<?php echo $chartincome ?>]
                }, {
                    name: 'รายจ่าย',
                    color: 'red',
                    data: [<?php echo $chartoutcome ?>]
                }, {
                    name: 'กำไร / ขาดทุน',
                    data: [<?php echo $chartprofit ?>]
                }]
        });
    });
</script>
