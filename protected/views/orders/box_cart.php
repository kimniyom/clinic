<div style="float:left;">จำนวนสินค้า </div>
<div style="float:right; color:#F00; font-weight:bold;">
    <?php
    if (isset($count)) {
        echo $count;
    } else {
        echo "0";
    }
    ?>
</div>
<br>          	
<div style="float:left;"> ราคา </div>
<div style="float:right; color:#F00; font-weight:bold;">
    <?php
    $sumall = 0;
    foreach ($result as $data):
        $sum = ($data['product_price'] * $data['product_num']);
        $sumall = $sumall + $sum;
    endforeach;

    echo number_format($sumall);
    ?>
</div>

