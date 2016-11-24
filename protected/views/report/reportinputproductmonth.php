<?php
$this->breadcrumbs = array(
    'รายงานเปรียบเทียบ ซื้อเข้า,ขายออก ของสินค้า ในแต่ละเดือน',
);

$ReportModel = new Report();
$BranchModel = new Branch();

$Branch = Yii::app()->session['branch'];
$yearNow = date("Y");
if (!empty($years)) {
    $year = $years;
} else {
    $year = $yearNow;
}
?>
<div class="row">
    <form action="<?php echo Yii::app()->createUrl('report/reportinputproductmonth') ?>" method="post">
        <div class="col-lg-1">
            <label style=" padding-top: 5px;">ปี พ.ศ. </label>
        </div>
        <div class="col-lg-4">
            <select id="year" name="year" class="form-control">
                <?php for ($i = $yearNow; $i >= ($yearNow - 1); $i--): ?>
                    <option value="<?php echo $i ?>" <?php if ($i == $year) echo "selected"; ?>><?php echo ($i + 543) ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-lg-4">
            <?php
            if ($Branch == '99') {
                $majer = Branch::model()->findAll("active = '1'");
                ?>
            <select id="branch" name="branch" class="form-control">
                <?php foreach($majer as $ms): ?>
                <option value="<?php echo $ms['id'] ?>" <?php if($ms['id'] == $branch) echo "selected";?>><?php echo $ms['branchname'] ?></option>
                <?php endforeach;?>
            </select>
            <?php } else { ?>
             <select id="branch" name="branch" class="form-control">
                 <option value="<?php echo $Branch ?>"><?php echo Branch::model()->find("id = '$Branch' ")['branchname'] ?></option>
            </select>
            <?php } ?>
        </div>
        <div class="col-lg-3">
            <input type="submit" value="ตกลง" class="btn btn-success"/>
        </div>
    </form>
</div>
<hr/>
<div class="row">
    <?php
    foreach ($month as $rs):
        ?>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" id="panel-head"><?php echo $rs['month_th'] . " " . ($year + 543) ?></div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>สินค้า</th>
                                <th style=" text-align: center;">ซื้อเข้า</th>
                                <th>ขาย</th>
                                <th>คงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($product as $p): $i++;
                                $inputAll = $ReportModel->getproductinputAll($year, $rs['id'], $p['product_id']);
                                $sell = $ReportModel->getproductsell($year, $rs['id'], $p['product_id']);
                                $stock = $ReportModel->getproductstockAll($year, $rs['id'], $p['product_id']);
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $p['product_name'] ?></td>
                                    <td style=" text-align: center; font-weight: bold;" class="text-primary"><?php echo $inputAll ?></td>
                                    <td style=" text-align: center; font-weight: bold;" class="text-success"><?php echo $sell ?></td>
                                    <td style="text-align: center; font-weight: bold;" class="text-danger"><?php echo $stock ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>
