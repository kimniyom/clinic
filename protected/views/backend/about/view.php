<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>

<?php
$title = "เกี่ยวกับเรา";
$this->breadcrumbs = array(
    $title,
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/Mail-icon.png" width="24"/>
        <?php echo $title ?>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('backend/about/create'); ?>"><i class="fa fa-pencil"></i> แก้ไข</a>
        </div>
    </div>
    <div class="panel-body">
        <div id="box-article">
            <?php echo $about['about'] ?>
        </div>
    </div>
</div>
