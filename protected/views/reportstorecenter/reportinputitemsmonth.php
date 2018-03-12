<?php
$Month = Month::model()->findAll();
?>
<style type="text/css">
    table thead th{
        white-space: nowrap;
    }

    table tbody td{
        white-space: nowrap;
    }

    table tfoot tr td{
        background:#000000;
        color:red;
    }
</style>
<div class="row" style=" margin: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">จำนวนนำเข้าวัตถุดิบ ปี <?php echo ($year + 543) ?> (จำนวน)</div>
            <div class="panel-body">
                <div class=" table-responsive">
                <table class="table table-bordered" style=" width: 100%;" id="ordersumall">
                    <thead>
                        <tr>
                            <th style=" text-align: center; background:#000000;">
                                เดือน
                                <hr/>
                                วัตถุดิบ
                            </th>
                            <?php foreach ($Month AS $m): ?>
                                <th style=" text-align: center;"><?php echo $m['month_th'] ?></th>
                            <?php endforeach; ?>
                            <th style=" text-align: center;">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tables as $rs):
                            $sum = $rs['month1'] + $rs['month2'] + $rs['month3'] + $rs['month4'] + $rs['month5'] + $rs['month6'] + $rs['month7'] + $rs['month8'] + $rs['month9'] + $rs['month10'] + $rs['month11'] + $rs['month12'];
                            ?>
                            <tr>
                                <td style="background:#000000;"><?php echo $rs['itemcode'] . ' ' . $rs['itemname'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month1']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month2']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month3']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month4']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month5']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month6']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month7']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month8']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month9']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month10']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month11']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rs['month12']) ?></td>
                                <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum) ?></td>
                            </tr>
                        <?php endforeach; ?>                      
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <div class="panel panel-default" style="margin:0px;">
            <div class="panel-heading">รายงานการซื้อเข้าวัตถุดิบ ปี <?php echo ($year + 543) ?> (ราคา)</div>
            <div class="panel-body">
                <div class=" table-responsive">
                <table class="table table-bordered table-responsive" style=" width: 100%;" id="ordersumalls">
                    <thead>
                        <tr>
                            <th style=" text-align: center; background:#000000;">
                                เดือน
                                <hr/>
                                วัตถุดิบ
                            </th>
                            <?php foreach ($Month AS $m): ?>
                                <th style=" text-align: center;"><?php echo $m['month_th'] ?></th>
                            <?php endforeach; ?>
                            <th style=" text-align: center;">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $summonth1 = 0;
                        $summonth2 = 0;
                        $summonth3 = 0;
                        $summonth4 = 0;
                        $summonth5 = 0;
                        $summonth6 = 0;
                        $summonth7 = 0;
                        $summonth8 = 0;
                        $summonth9 = 0;
                        $summonth10 = 0;
                        $summonth11 = 0;
                        $summonth12 = 0;
                        foreach ($itemsprice as $rss):
                            $sumPrice = $rss['month1'] + $rss['month2'] + $rss['month3'] + $rss['month4'] + $rss['month5'] + $rss['month6'] + $rss['month7'] + $rss['month8'] + $rss['month9'] + $rss['month10'] + $rss['month11'] + $rss['month12'];
                            $summonth1 = $summonth1 + $rss['month1'];
                            $summonth2 = $summonth2 + $rss['month2'];
                            $summonth3 = $summonth3 + $rss['month3'];
                            $summonth4 = $summonth4 + $rss['month4'];
                            $summonth5 = $summonth5 + $rss['month5'];
                            $summonth6 = $summonth6 + $rss['month6'];
                            $summonth7 = $summonth7 + $rss['month7'];
                            $summonth8 = $summonth8 + $rss['month8'];
                            $summonth9 = $summonth9 + $rss['month9'];
                            $summonth10 = $summonth10 + $rss['month10'];
                            $summonth11 = $summonth11 + $rss['month11'];
                            $summonth12 = $summonth12 + $rss['month12'];
                            ?>
                            <tr>
                                <td style="background:#000000;"><?php echo $rss['itemcode'] . ' ' . $rss['itemname'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month1']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month2']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month3']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month4']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month5']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month6']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month7']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month8']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month9']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month10']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month11']) ?></td>
                                <td style=" text-align: right;"><?php echo number_format($rss['month12']) ?></td>
                                <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sumPrice) ?></td>
                            </tr>
                        <?php endforeach; ?>                      
                    </tbody>
                    <tfoot>
                        <?php $total = $summonth1 + $summonth2 + $summonth3 + $summonth4 + $summonth5 + $summonth6 + $summonth7 + $summonth8 + $summonth9 + $summonth10 + $summonth11 + $summonth12;
                        ?>
                        <tr>
                            <td style=" text-align: center; font-weight: bold;">รวม</td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth1, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth2, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth3, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth4, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth5, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth6, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth7, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth8, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth9, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth10, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth11, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($summonth12, 2) ?></td>
                            <td style=" text-align: right; font-weight: bold;"><?php echo number_format($total, 2) ?></td>
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
        $("#ordersumall,#ordersumalls").dataTable({
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 10, // กำหนดค่า default ของจำนวน record 
            "bFilter": false, // แสดง search box
            "paging": false,
            fixedColumns: true,
            "info": false,
            "scrollX": true,
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
                    title: 'รายงานซื้อเข้าวัตถุดิบ ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'excelHtml5',
                    title: 'รายงานซื้อเข้าวัตถุดิบ ปี ' + '<?php echo $year ?>'
                },
                {
                    extend: 'print',
                    title: 'รายงานซื้อเข้าวัตถุดิบ ปี ' + '<?php echo $year ?>'
                }]
        });
    });
</script>



