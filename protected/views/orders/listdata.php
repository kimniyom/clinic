<style type="text/css">
    #tablelistorder tfoot tr td{
        font-weight: bold;
    }
</style>
<?php
$Thaibath = new Thaibaht();
?>
<table style=" width: 100%;" class="table table-bordered" id="tablelistorder">
    <thead>
        <tr>
            <th>#</th>
            <th>รหัสสินค้า</th>
            <th>สินค้า</th>
            <th style=" text-align: center;">จำนวน</th>
            <th style=" text-align: center;">หน่วยนับ</th>
            <th style=" text-align: center;">ราคา/หน่วย</th>
            <th>จำนวนเงิน</th>
            <th style=" text-align: center;">ยกเลิก</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sumdistcount = 0;
        $sumproduct = 0;
        $i = 0;
        foreach ($order as $rs):
            $i++;
            $sumrow = ($rs['costs'] * $rs['number']);
            $sumproduct = ($sumproduct + $sumrow);
            $sumdistcount = ($sumdistcount + $rs['distcountprice']);
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['product_id'] ?></td>
                <td><?php echo $rs['product_nameclinic'] ?></td>
                <td style=" text-align: center;"><?php echo number_format($rs['number']) ?></td>
                <td style=" text-align: center;"><?php echo $rs['unitname'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($rs['costs'],2) ?></td>
                <td style=" text-align: right;"><?php echo number_format($sumrow, 2) ?></td>
                <td style=" text-align: center;">
                    <a href="javascript:deleteproduct('<?php echo $rs['id'] ?>')"><i class="fa fa-remove"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" rowspan="5">
                หมายเหตุ
            </td>
        </tr>
        <tr>
            <td>รวมเงิน</td>
            <td style=" text-align: right;"><?php echo number_format($sumproduct, 2) ?></td>
            <td></td>
        </tr>
        <tr>
            <td>ส่วนลดคิดเป็นเงิน</td>
            <td style=" text-align: right;"><?php echo number_format($sumdistcount,2) ?></td>
            <td></td>
        </tr>
        <tr>
            <td>ราคาหลังหักส่วนลด</td>
            <td style=" text-align: right;">
                <?php
                $priceresult = ($sumproduct - $sumdistcount);
                echo number_format($priceresult,2);
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>ภาษี 7%</td>
            <td style=" text-align: right;">
                <?php
                $tax = ($priceresult * 7) / 100;
                $taxresult = number_format($tax, 2);
                echo $taxresult;
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5" style=" text-align: center;">
                <?php
                $pricetotal = number_format(($priceresult + $tax),2);
                $priceCovert = str_replace(",", "", $pricetotal);
                if(substr($priceCovert,-2) == "00"){
                    $priceCoverts  = str_replace(".00", "", $priceCovert);
                } else {
                    $priceCoverts = $priceCovert;
                }
                
                echo "(".$Thaibath->convert($priceCoverts).")";
                ?>
            </td>
            <td>รวมเงินทั้งสิ้น</td>
            <td style=" text-align: right;"><?php echo number_format(sprintf('%.2f',$priceCovert),2); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>



<script type="text/javascript">
    function deleteproduct(id) {
        var r = confirm("Are you sure ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('listorder/deleteproduct') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                loaddata();
            });
        }
    }
</script>
