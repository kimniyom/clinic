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
</style>
<div class="row" style=" margin: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">จำนวนนำเข้าวัตถุดิบ ปี <?php echo $year ?> (จำนวน)</div>
            <div class="panel-body">
                <table class="table table-bordered" style=" width: 100%;" id="ordersumall">
                    <thead>
                        <tr>
                            <th style=" text-align: center;">
                                เดือน
                                <hr/>
                                วัตถุดิบ
                            </th>
                            <?php foreach($Month AS $m): ?>
                                <th style=" text-align: center;"><?php echo $m['month_th']?></th>
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
                                <td><?php echo $rs['itemcode'].' '.$rs['itemname'] ?></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month1']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month2']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month3']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month4']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month5']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month6']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month7']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month8']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month9']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month10']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month11']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rs['month12']) ?></a></td>
                                <td style=" text-align: right; font-weight: bold;"><a href=""><?php echo number_format($sum) ?></a></td>
                            </tr>
                        <?php endforeach; ?>                      
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-inverse">
            <div class="panel-heading">รายงานการซื้อเข้าวัตถุดิบ ปี. <?php echo $year ?> (ราคา)</div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive" style=" width: 100%;" id="ordersumalls">
                    <thead>
                        <tr>
                            <th style=" text-align: center;">
                                เดือน
                                <hr/>
                                วัตถุดิบ
                            </th>
                            <?php foreach($Month AS $m): ?>
                                <th style=" text-align: center;"><?php echo $m['month_th']?></th>
                            <?php endforeach; ?>
                            <th style=" text-align: center;">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($itemsprice as $rss):
                            $sumPrice = $rss['month1'] + $rss['month2'] + $rss['month3'] + $rss['month4'] + $rss['month5'] + $rss['month6'] + $rss['month7'] + $rss['month8'] + $rss['month9'] + $rss['month10'] + $rss['month11'] + $rss['month12'];
                            ?>
                            <tr>
                                <td><?php echo $rss['itemcode'].' '.$rss['itemname'] ?></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month1']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month2']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month3']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month4']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month5']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month6']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month7']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month8']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month9']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month10']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month11']) ?></a></td>
                                <td style=" text-align: right;"><a href=""><?php echo number_format($rss['month12']) ?></a></td>
                                <td style=" text-align: right; font-weight: bold;"><a href=""><?php echo number_format($sumPrice) ?></a></td>
                            </tr>
                        <?php endforeach; ?>                      
                    </tbody>
                </table>
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



