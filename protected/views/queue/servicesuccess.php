<style type="text/css">
    table{
        background: #FFFFFF;
    }
    .modal.large {
        width: 80%;
    }
</style>

<table class="table table-striped table-bordered" style=" margin-top: 10px;">
    <thead>
        <tr>
            <td style=" width: 5%; text-align: center;">#</td>
            <td>ชื่อ - สกุล</td>
            <td style=" text-align: center;">อายุ</td>
            <td style=" text-align: center;">รหัสบัตรประชาชน</td>
            <td>อาการที่มารักษา</td>
            <td style=" text-align: center;">ลบคิว</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($seq as $rs):
            $i++;
            if ($i == 1) {
                $icon = '<i class="fa fa-arrow-right"></i>';
                $color = 'red';
            } else {
                $icon = '';
                $color = '';
            }
            ?>
            <tr style="color: <?php echo $color ?>;">
                <td style=" text-align:center;"><?php echo $icon . ' ' . $rs['id'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td style=" text-align:center;"><?php echo $rs['age'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['card'] ?></td>
                <td><?php echo $rs['comment'] ?></td>
                <td style=" text-align: center;">
                    <a href="javascript:deleteservice('<?php echo $rs['id']?>')"><i class="fa fa-trash-o"></i></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function deleteservice(id){
        var r = confirm("Are you sure...?");
        if(r == true){
            var url = "<?php echo Yii::app()->createUrl('queue/deleteservice')?>";
            var data = {id: id};
            $.post(url,data,function(datas){
                loadtable();
            });
        }
    }
</script>
