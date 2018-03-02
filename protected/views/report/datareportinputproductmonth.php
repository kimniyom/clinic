<?php
$config = new Configweb_model();
?>
<div class="row" style="margin: 5px 0px 0px 0px;">
    <div class="col-md-6 col-lg-6">
        <div class="panel panel-default" style=" margin-bottom: 0px;">
            <div class="panel-heading">นำเข้าสินค้าเดือน <?php echo $config->MonthFullArray()[(int)$monthlast] ?> <?php echo ($yearlast + 543) ?></div>
            <div class="panel-body">
                <table class="table table-bordered" id="tb-inputlast">
                    <thead>
                        <tr style=" background: #000000;">
                            <th>สินค้า</th>
                            <th style="text-align: right;">นำเข้า</th>
                            <th style=" text-align: right;">ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sumRowlast = 0;
                        $sumalllast= 0;
                        foreach ($sellmonthlast as $last):
                            $sumRowlast = ($last['total'] * $last['costs']);
                            $sumalllast = ($sumalllast + $sumRowlast);
                            ?>
                            <tr>
                                <td><?php echo $last['product_nameclinic'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($last['total']) ?> <?php echo $last['unit'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($sumRowlast, 2) ?> .-</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style=" background: #000000;">
                            <td colspan="2" style=" text-align: center; font-weight: bold;">รวม</td>
                            <td style="text-align: right; font-weight: bold;"><?php echo number_format($sumalllast,2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="panel panel-default" style=" margin-bottom: 0px;">
            <div class="panel-heading">นำเข้าสินค้าเดือน <?php echo $config->MonthFullArray()[(int) $monthnow] ?> <?php echo ($yearnow + 543) ?></div>
            <div class="panel-body">
                <table class="table table-bordered" id="tb-inputnow">
                    <thead>
                        <tr style=" background: #000000;">
                            <th>สินค้า</th>
                            <th style="text-align: right;">นำเข้า</th>
                            <th style=" text-align: right;">ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sumRownow = 0;
                        $sumallnow = 0;
                        foreach ($sellmonthnow as $now): 
                            $sumRownow = ($now['total'] * $now['costs']);
                            $sumallnow = ($sumallnow + $sumRownow);
                            ?>
                            <tr>
                                <td><?php echo $now['product_nameclinic'] ?></td>
                                <td style="text-align: right;"><?php echo number_format($now['total']) ?> <?php echo $now['unit'] ?></td>
                                <td style=" text-align: right;"><?php echo number_format($sumRownow, 2) ?> .-</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style=" background: #000000;">
                            <td colspan="2" style=" text-align: center; font-weight: bold;">รวม</td>
                            <td style="text-align: right; font-weight: bold;"><?php echo number_format($sumallnow,2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
       var w = window.innerWidth;
       var screenfull;
       if(w >= 768){
           screenfull = (boxsell - 385);
       } else {
           screenfull = false;
       }
        $("#tb-inputlast,#tb-inputnow").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ]
        });
    }

</script>