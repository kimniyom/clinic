<script>
    $(document).ready(function () {
        $(".breadcrumb").hide();
        $("#m-left").hide();
    });
</script>
<div class="panel panel-default" style=" margin-top: 20px;">
    <div class="panel-heading"><i class="fa fa-cog"></i> เมนู</div>
    <div class="panel-body">
        <div class="row">
            <?php
            $MenuModel = new Menu();
            $UserModel = new Masuser();
            $product_model = new Backend_product();
            $AppointModel = new Appoint();
            $Profile = $UserModel->GetProfile();
            $MenuSystem = $MenuModel->Getrolemenu($Profile['user_id']);
            $i = 0;
            foreach ($MenuSystem as $mn):
                $linkmenu = $mn['link'];
                $icon = $mn['icon'];
                $i ++;
                ?>
                <div class="col-md-3 col-lg-2 col-xs-6" style=" margin-bottom: 20px;">
                    <a href="<?php echo Yii::app()->createUrl($linkmenu) ?>" onclick="setactivemenu('<?php echo "M".$i ?>')">
                        <div class="btn btn-default btn-block">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $icon ?>"
                                 height="48px"/><br/>
                            <h4><?php echo $mn['menu'] ?></h4>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="panel panel-warning">
    <div class="panel-heading"><i class="fa fa-bell-o"></i> แจ้งเตือน</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3 col-lg-2 col-xs-6" style=" margin-bottom: 20px;">
                <a href="<?php echo Yii::app()->createUrl('backend/stock/expireproduct') ?>">
                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                        <?php echo $product_model->stockproductalert(); ?>
                    </span>
                    <div class="btn btn-default btn-block">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png" height="48px"/><br/>
                        สินค้าใกล้หมด
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-2 col-xs-6" style=" margin-bottom: 20px;">
                <a href="<?php echo Yii::app()->createUrl('backend/stock/expireitem') ?>">
                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                        <?php echo $product_model->stockitemalert(); ?>
                    </span>
                    <div class="btn btn-default btn-block">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                             height="48px" /><br/>
                        สินค้าใกล้หมดอายุ
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-2 col-xs-6" style=" margin-bottom: 20px;">
                <a href="<?php echo Yii::app()->createUrl('appoint/appointover') ?>">
                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                        <?php echo $AppointModel->Countover(); ?>
                    </span>
                    <div class="btn btn-default btn-block">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png" height="48px"/><br/>
                        นัดลูกค้า
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>