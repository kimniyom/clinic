<table class="table table-bordered">
    <thead>
        <tr>
            <th style=" text-align: center;">#</th>
            <th>ชื่อ - สกุล</th>
            <th style=" text-align: center;">เลื่อก</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach($appoint as $rs): $i++;?>
        <tr>
            <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
            <td><a href="#"><?php echo $rs['name']." ".$rs['lname'] ?></a></td>
            <td style="text-align: center;"><i class="fa fa-trash-o"></i></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

