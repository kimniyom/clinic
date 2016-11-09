<style type="text/css">
    #article-box{
        height: 50px;
        overflow: hidden;
    }
</style>

<?php if(empty($article)){ ?>
<script type="text/javascript">
    $(".load_more").attr("disabled", "disabled");
</script>
<?php } ?>
<div class="row">
    <?php
    $config = new Configweb_model();
    $a = 0;
    foreach ($article as $art):
        $a++;
        if (!empty($art['images'])) {
            $img_art = "uploads/article/" . $art['images'];
        } else {
            $img_art = "images/No_image_available.jpg";
        }
        $link = Yii::app()->createUrl('frontend/article/view/id/' . $config->url_encode($art['id']));
        ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_art; ?>" class="img-responsive article-img"/>
                <div class="caption"id="article-box">
                    <p><?php echo $art['title']; ?></p>
                </div>
                <p style=" text-align: right;"><a href="<?php echo $link;?>" class="btn btn-default btn-sm" role="button"><i class="fa fa-angle-double-right"></i> รายละเอียด</a></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<script>
    $(document).ready(function () {
        var width = $(window).width();
        if (width > 768) {
            $("#banner_home").show();
            var style = {
                "height": "120px"
            };
            $(".article-img").css(style);
        } else {
            $("#banner_home").hide();
            var style = {
                "height": "auto"
            };
            $(".article-img").css(style);
        }
    });



    $(window).resize(function () {
        var widths = $(window).width();
        if (widths > 768) {
            $("#banner_home").show();
            var style = {
                "height": "120px"
            };
            $(".article-img").css(style);
        } else {
            $("#banner_home").hide();
            var style = {
                "height": "auto"
            };
            $(".article-img").css(style);
        }
    });
</script>