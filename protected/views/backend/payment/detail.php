<table class="table">
    <tbody>
        <?php
        $i = 1;
        foreach ($payment as $rs): $i++;
            ?>
            <tr>
                <td style="text-align:center;">
                    <img src="<?php echo Yii::app()->baseUrl . '/images/' . $rs['bank_img']; ?>" width="30"/>
                </td>
                <td>
                    <?php echo $rs['bank_name']; ?>
                </td>
                <td><?php echo $rs['bookbank_name']; ?></td>
                <td><?php echo $rs['bank_branch']; ?></td>
                <td><?php echo $rs['bookbank_number']; ?></td>
                <td>
                    <div class="btn btn-danger" onclick="delete_payment('<?php echo $rs['id'] ?>');" title="ลบ">
                        <i class="fa fa-trash"></i>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

