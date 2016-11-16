<style type="text/css">
    #t_hover tbody tr{
        color: #66cc00;
    }
    #t_hover tbody tr:hover{
        background: #666666;
        color: #ffcc00;
    }
</style>
<?php
$web = new Configweb_model();
?>
<table class="table table-bordered" id="t_hover">
    <thead>
        <tr>
            <th style="width: 5%; text-align: center;">#</th>
            <th style="text-align: center; width: 15%;">วันที่</th>
            <th>หัตถการ</th>
            <th>อาการสำคัญ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($service as $rs):
            $i++;
            $url = Yii::app()->createUrl('historyservice/historyresult', array("service_id" => $rs['id']));
            ?>
            <tr onclick="javasript:PopupCenter('<?php echo $url ?>','ประวัติการรับบริการ')" style=" cursor: pointer;">
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td style=" text-align: center;"><?php echo $web->thaidate($rs['service_date']) ?></td>
                <td><?php echo $rs['diagname'] ?></td>
                <td><?php echo $rs['cc'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



