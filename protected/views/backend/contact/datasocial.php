
<?php if(empty($social)){ ?>
    <center>ไม่มีข้อมูล</center>
<?php } ?>
<table class="table">
  <?php foreach($social as $datas):?>
  <tr>
      <td style="text-align:center;">
          <img src="<?php echo Yii::app()->baseUrl;?>/images/<?php echo $datas['icon']?>" width="24"/>
      </td>
      <td><?php echo $datas['social_app'] ?></td>
      <td><?php echo $datas['account'] ?></td>
      <td>
      <i class="btn btn-danger btn-sm fa fa-trash" title="ลบ" 
        onclick="delete_social('<?php echo $datas['id']?>')"></i>
      </td>
  </tr>
  <?php endforeach; ?>
</table>
