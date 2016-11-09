<script type="text/javascript">
    $(document).ready(function () {
        var style = {"height": "auto"};
        $("#box-article img").addClass("img-responsive");
        $("#box-article img").css(style);
    });
</script>
<?php
$config = new Configweb_model();
$this->breadcrumbs = array(
    "บทความ" => array('frontend/article'),
    $result['title'],
);
?>

<br/>
<div class="well" style="border-radius: 0px; background: none;" id="box-article">
    <h4><?php echo $result['title'] ?></h4>
    <br/>
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