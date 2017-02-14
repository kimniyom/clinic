<?php
$orderModel = new Orders();
$Config = new Configweb_model();
?>    
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>เลขที่สั่งซื้อ</th>
            <th>วันที่สั่งซื้อ</th>
            <th>จำนวน</th>
            <th>สถานะ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($order as $rs):$i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><a href="<?php echo Yii::app()->createUrl('orders/view', array('order_id' => $rs['order_id'])) ?>">
                        <?php echo $rs['order_id'] ?></a>
                </td>
                <td><?php echo $Config->thaidate($rs['create_date']) ?></td>
                <td><?php echo number_format($rs['total']) ?></td>
                <td>
                    <?php echo $orderModel->SetstatusOrder($rs['status']) ?></td>
                <td style=" text-align: center;">
                    <?php if ($rs['status'] == '0') { ?>
                    <a href="<?php echo Yii::app()->createUrl('orders/update',array('order_id' => $rs['order_id']))?>">
                        <i class="fa fa-pencil"></i> แก้ไข</a>
                        <a href="javascript:Deleteorder('<?php echo $rs['order_id']?>')">
                            <i class="fa fa-remove"></i> ยกเลิก</a>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

