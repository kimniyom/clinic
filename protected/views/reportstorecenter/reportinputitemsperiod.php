<style type="text/css">
    #ordersumall tfoot tr td{
        background:#000000;
        color: red;
        white-space: nowrap;
    }
    #ordersumall thead tr th{
        white-space: nowrap;
    }
    #ordersumall tbody tr td{
        white-space: nowrap;
    }

    #ordersumalls tfoot tr td{
        background:#000000;
        color: red;
        white-space: nowrap;
    }
    #ordersumalls thead tr th{
        white-space: nowrap;
    }
    #ordersumalls tbody tr td{
        white-space: nowrap;
    }
</style>
<div class="row" style=" margin: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">จำนวนนำเข้าวัตถุดิบ ปี <?php echo $year ?></div>
            <div class="panel-body">
                <div class=" table-responsive">
                    <table class="table table-bordered" style=" width: 100%;" id="ordersumall">
                        <thead>
                            <tr>
                                <th>วัตถุดิบ</th>
                                <th style=" text-align: center;">ไตรมาส 1</th>
                                <th style=" text-align: center;">ไตรมาส 2</th>
                                <th style=" text-align: center;">ไตรมาส 3</th>
                                <th style=" text-align: center;">ไตรมาส 4</th>
                                <th style=" text-align: center;">รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($tables as $rs):
                                $sum = $rs['period1'] + $rs['period2'] + $rs['period3'] + $rs['period4'];
                                ?>
                                <tr>
                                    <td><?php echo $rs['itemcode'] . ' ' . $rs['itemname'] ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rs['period1']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rs['period2']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rs['period3']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rs['period4']) ?></td>
                                    <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sum) ?></td>
                                </tr>
                            <?php endforeach; ?>                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel panel-default" style="margin:0px;">
            <div class="panel-heading">รายงานการซื้อเข้าวัตถุดิบ ปี. <?php echo $year ?></div>
            <div class="panel-body">
                <div class=" table-responsive">
                    <table class="table table-bordered" style=" width: 100%;" id="ordersumalls">
                        <thead>
                            <tr>
                                <th>วัตถุดิบ</th>
                                <th style=" text-align: center;">ไตรมาส 1</th>
                                <th style=" text-align: center;">ไตรมาส 2</th>
                                <th style=" text-align: center;">ไตรมาส 3</th>
                                <th style=" text-align: center;">ไตรมาส 4</th>
                                <th style=" text-align: center;">รวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sumP1 = 0;
                            $sumP2 = 0;
                            $sumP3 = 0;
                            $sumP4 = 0;
                            $sumPAll = 0;
                            foreach ($itemsprice as $rss):
                                $sumprice = $rss['period1'] + $rss['period2'] + $rss['period3'] + $rss['period4'];
                                $sumP1 = $sumP1 + $rss['period1'];
                                $sumP2 = $sumP2 + $rss['period2'];
                                $sumP3 = $sumP3 + $rss['period3'];
                                $sumP4 = $sumP4 + $rss['period4'];
                                $sumPAll = $sumP1 + $sumprice;
                                ?>
                                <tr>
                                    <td><?php echo $rss['itemcode'] . ' ' . $rss['itemname'] ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rss['period1']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rss['period2']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rss['period3']) ?></td>
                                    <td style=" text-align: right;"><?php echo number_format($rss['period4']) ?></td>
                                    <td style=" text-align: right; font-weight: bold;"><?php echo number_format($sumprice) ?></td>
                                </tr>
                            <?php endforeach; ?>                      
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style=" text-align:  center; font-weight: bold;">รวม</td>
                                <td style=" text-align: right;font-weight: bold;"><?php echo number_format($sumP1) ?></td>
                                <td style=" text-align: right;font-weight: bold;"><?php echo number_format($sumP2) ?></td>
                                <td style=" text-align: right;font-weight: bold;"><?php echo number_format($sumP3) ?></td>
                                <td style=" text-align: right;font-weight: bold;"><?php echo number_format($sumP4) ?></td>
                                <td style=" text-align: right;font-weight: bold;"><?php echo number_format($sumPAll) ?></td>
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



