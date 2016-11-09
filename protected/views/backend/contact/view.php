<?php
$title = "การติดต่อ";
$this->breadcrumbs = array(
    $title,
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<img src="<?php echo Yii::app()->baseUrl;?>/images/Contact-icon.png" width="24"/>
    <?php echo $title ?>
		<div class="pull-right">
			<a href="<?php echo Yii::app()->createUrl('backend/contact/create');?>"><i class="fa fa-pencil"></i> แก้ไข</a>
		</div>
	</div>
	<div class="panel-body">
    <h3><img src="<?php echo Yii::app()->baseUrl;?>/images/Phone-icon.png" width="24"/> ข้อมูลติดต่อ</h3>
    <?php if(!empty($contact)){ ?>
      <label style="margin-left:20px;">อีเมล์</label> <?php echo $contact['email']?><br/>
      <label style="margin-left:20px;">เบอร์โทรศัพท์</label> <?php echo $contact['tel']?>
    <?php } else { ?>
      <center>ไม่มีข้อมูลส่วนนี้</center>
    <?php } ?>
    <br/><br/>

    <h3><img src="<?php echo Yii::app()->baseUrl;?>/images/Social-network-icon.png" width="24"/> โซเชียลมีเดีย</h3>
    <?php if(empty($social)){ ?>
        <center>ไม่มีข้อมูลส่วนนี้</center>
    <?php } ?>
    <table class="table">
      <?php foreach($social as $datas):?>
      <tr>
          <td style="text-align:center;">
              <img src="<?php echo Yii::app()->baseUrl;?>/images/<?php echo $datas['icon']?>" width="24"/>
          </td>
          <td><?php echo $datas['social_app'] ?></td>
          <td><?php echo $datas['account'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>

	</div>
</div>
