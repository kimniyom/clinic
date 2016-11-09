<div class="row">
    <?php
    foreach ($images as $rs):
        $id = $rs['id'];
        $images = $rs['images'];
        ?>
        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
            <div class="thumbnail" style=" text-align: center; background: #FFF; padding: 0px;" id="">
                <div class="img-wrapper">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?php echo $rs['images']; ?>" class="img-responsive" style="height: 100px;"/>
                </div>
                <div class="caption">
                    <a href="javascript:delete_images('<?php echo $id ?>','<?php echo $images ?>')">
                        <div class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</div></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>