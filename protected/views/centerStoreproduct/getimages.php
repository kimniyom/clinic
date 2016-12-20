<div class="row">
    <?php
    foreach ($images as $rs):
        $id = $rs['id'];
        $images = $rs['images'];
        ?>
        <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
            <div class="thumbnail" style=" text-align: center; background: #FFF; padding: 0px;" id="">
                <div class="img-wrapper">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?php echo $rs['images']; ?>" class="img-responsive" style="height: 150px;"/>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>