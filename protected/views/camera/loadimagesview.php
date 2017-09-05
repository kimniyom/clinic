<script type="text/javascript">
    $(document).ready(function () {
        $('.img_zoom').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: {
                enabled: true
            }
            // other options
        });

    });
</script>
<div class=" row" style=" margin: 0px;">
    <?php foreach ($images as $rs): ?>
        <div class="col-lg-2 col-md-2" style="padding: 0px;">
            <!-- Img -->
            <div class="img_zoom">
                <a class="image-link" href="<?php echo Yii::app()->baseUrl; ?>/uploads/saved_images/<?= $rs['images'] ?>">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/saved_images/<?= $rs['images'] ?>" class="img img-responsive" id="im-resize"/></a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
