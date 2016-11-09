<div class="panel panel-default">
  <div class="panel-heading">Result</div>
    <?php if(empty($transport)){ ?>
        <center>ไม่มีข้อมูลส่วนนี้</center>
    <?php } ?>

    <table class="table">
      <thead>
        <tr>
          <th style="text-align:center;">#</th>
          <th>ราคา</th>
          <th>รายละเอียด</th>
          <th></th>
        </tr>
      </thead>
      <?php $i=0;foreach($transport as $datas):$i++;?>
      <tr>
          <td style="text-align:center;"><?php echo $i; ?></td>
          <td><?php echo $datas['price'] ?></td>
          <td><?php echo $datas['detail'] ?></td>
          <td><i class="btn btn-danger btn-sm fa fa-trash" onclick="delete_transport('<?php echo $datas['id']?>')"></i></td>
      </tr>
      <?php endforeach; ?>
    </table>
</div>
