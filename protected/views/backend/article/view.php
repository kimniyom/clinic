<?php
$config = new Configweb_model();
$this->breadcrumbs = array(
    "บทความทั้งหมด" => array('backend/article'),
    $result['title'],
);
?>
<div class="pull-right">
    <a href="<?php echo Yii::app()->createUrl('backend/article/update/id/' . $result['id']) ?>">
        <button type="button" class="btn btn-warning btn-sm" title="แก้ไข"><i class="fa fa-edit"></i> แก้ไข</button></a>
    <button type="button" class="btn btn-danger btn-sm" title="ลบ" onclick="delete_article('<?php echo $result['id']?>')"><i class="fa fa-trash"></i> ลบ</button>
</div>
<div class="well" style="border-left: solid #009900 3px; border-radius: 0px; background: none;">
    <div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
            <?php if (!empty($result['images'])) { ?>
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/article/<?php echo $result['images'] ?>" style=" max-width: 100%;" class="img-responsive"/>
            <?php } else { ?>
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/No-image.jpg" style=" max-width: 100%;" class="img-responsive"/>
            <?php } ?>
        </div>
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
            <h4><?php echo $result['title'] ?></h4>
        </div>
    </div>

</div>

<div class="well" style="border-radius: 0px; background: none;">
    <?php echo $result['detail']; ?><br/><br/>
    <i class="fa fa-user"></i> <?php echo $result['name'] . ' ' . $result['lname'] ?>
    <i class="fa fa-calendar"></i> <?php echo $result['create_date'] ?>
    <br/><br/>
</div>

<script>
    function delete_article(id) {
        var url = "<?php echo Yii::app()->createUrl('backend/article/delete') ?>";
        var r = confirm("คุณแน่ใจหรือไม่ ...?");
        var data = {id: id};
        if (r == true) {
            $.post(url, data, function (success) {
                window.location = "<?php echo Yii::app()->createUrl('backend/article') ?>";
            });
        }
    }
</script>