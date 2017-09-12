
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รหัส</th>
                    <th>วัตถุดิบ</th>
                    <th style=" text-align: right;">จำนวน</th>
                    <th style=" text-align: center;">ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($mixer as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['itemscode'] ?></td>
                        <td><?php echo $rs['itemname'] ?></td>
                        <td style=" text-align: right; color: #ff0000;"><?php echo $rs['number'] . ' ' . $rs['unit'] ?></td>
                        <td style=" text-align: center;">
                            <a href="javascript:deletemixer('<?php echo $rs['id'] ?>')"><i class="fa fa-trash"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
