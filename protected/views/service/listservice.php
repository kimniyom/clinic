
<?php
/*
  s.service_date,
  p.card,
  p.`name`,
  p.lname,
  e.`name` AS empname,
  e.lname AS emplname,
  ed.`name` AS doctorname,ed.lname AS doctorlname,
  po.position AS positionemp,pod.position AS positiondoctor
 */
//$User = new Masuser();
//$BranchModel = new Branch();
$Config = new Configweb_model();

?>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center; width: 5%;">#</th>
                <th>รายการ</th>
                <th style=" text-align: center; width: 10%;">จำนวน</th>
                <th style=" text-align: center; width: 10%;">ราคา / หน่วย</th>
                <th style=" text-align: center; width: 10%;">รวม</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            foreach ($listservice as $rs):
                $i++;
                $sum = ($sum + $rs['total']);
                ?>
                <tr>
                    <td style=" text-align: center;"><?php echo $i ?></td>
                    <td><?php echo $rs['detail'] ?></td>
                    <td style=" text-align: center;"><?php echo $rs['number'] ?></td>
                    <td style="text-align: right;">​<?php echo number_format($rs['price'], 2) ?></td>
                    <td style="text-align: right;">​<?php echo number_format($rs['total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">รวม</td>
                <td style="text-align: right;"><?php echo number_format($sum, 2); ?></td>
            </tr>
            <!--
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">ส่วนลด</td>
                <td style="text-align: right;"><?php //echo number_format($logsell['distcount'], 2);  ?></td>
            </tr>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">ราคาหักส่วนลด</td>
                <td style="text-align: right;"><?php //echo number_format($logsell['totalfinal'], 2);  ?></td>
            </tr>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">รับเงิน</td>
                <td style="text-align: right;"><?php //echo number_format($logsell['income'], 2);  ?></td>
            </tr>
            <tr>
                <td style=" text-align: right; font-weight: bold;" colspan="4">เงินทอน</td>
                <td style="text-align: right;"><?php //echo number_format($logsell['change'], 2);  ?></td>
            </tr>
            -->
        </tfoot>
    </table>
    


