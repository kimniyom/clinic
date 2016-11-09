<?php 
$web = new Configweb_model();
foreach($comment as $rs):?>

<div class="media">
	<?php if(Yii::app()->session['pid'] == $rs['pid']){ ?>
	<div class="pull-right">
		<a href="javascript:popup_update_comment('<?php echo $rs['id']?>')" title="แก้ไข"><i class="fa fa-pencil"></i></a>
		<a href="javascript:delete_comment('<?php echo $rs['id']?>')" title="ลบ"><i class="fa fa-trash"></i></a>
	</div>
	<?php } ?>
  <div class="media-left">
  	<?php if(isset($rs['images'])){ ?>
      <img class="media-object img-thumbnail" src="<?php echo Yii::app()->baseUrl;?>/uploads/profile/<?php echo $rs['images']?>" alt="..." style="max-width:30px;">
  	<?php } else {?>
  		<img class="media-object img-thumbnail" src="<?php echo Yii::app()->baseUrl;?>/images/user-icon.png" alt="..." style="max-width:30px;">
  	<?php } ?>
  </div>
  <div class="media-body">
   <?php echo $rs['comment']?><br/>
   <font style="color:#bbb; font-size:13px;">
	    <i class="fa fa-user"></i> <?php echo $rs['alias']?>
	    <i class="fa fa-calendar"></i> <?php echo $web->thaidate($rs['d_update'])?>
	</font>
  </div>
</div>

<?php endforeach;?>

<?php if(empty($comment)){ ?>
	<center>แสดงความคิดเห็นเป็นคนแรก</center>
<?php } ?>
<hr/>

<?php if(!empty(Yii::app()->session['pid'])){?>
<div class="input-group">
    <input type="text" id="box_comment" class="form-control" placeholder="แสดงความคิดเห็น...">
   	<span class="input-group-btn">
    	<button class="btn btn-default" type="button" onclick="send_comment()"><i class="fa fa-send"></i> ส่ง</button>
    </span>
</div><!-- /input-group -->
<?php } else {?>

	<center>เข้าสู่ระบบเพื่อแสดงความคิดเห็น</center>

<?php } ?>

<script type="text/javascript">
	function popup_update_comment(id){
		var url = "<?php echo Yii::app()->createUrl('frontend/comment/update')?>";
		var data = {id: id};

		$.post(url,data,function(result){
			$("#show_comment").html(result);
			$("#popup_update_comment").modal();
		});
	}

	function delete_comment(id){
		var url = "<?php echo Yii::app()->createUrl('frontend/comment/delete')?>";
		var data = {id: id};
		var r = confirm("คุณแน่ใจหรือไม่ ... ?");
		if(r == true){
			$.post(url,data,function(result){
				load_comment();
			});
		}
		
	}
</script>



