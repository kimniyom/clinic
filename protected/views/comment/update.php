<label>
	ความคิดเห็นของคุณ <?php echo $comment['id']?>
</label>
<textarea id="txt_comment" name="txt_comment" class="form-control"><?php echo $comment['comment'] ?></textarea>
<br/>
<div style="text-align:center">
	<button class="btn btn-default" onclick="save_update_comment()"><i class="fa fa-save"></i> แก้ไขข้อมูล</button>
</div>

<script type="text/javascript">
	function save_update_comment(){
		var url = "<?php echo Yii::app()->createUrl('frontend/comment/update_comment')?>";
		var id = "<?php echo $comment['id']?>";
		var comment = $("#txt_comment").val();
		var data = {id: id,comment: comment};
		if(comment == ''){
			$("#txt_comment").focus();
			return false;
		}

		$.post(url,data,function(success){
			$("#popup_update_comment").modal('hide');
			load_comment();
		});
	}
</script>