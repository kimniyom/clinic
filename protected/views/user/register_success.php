<div class="alert" style="text-align: center;">
    <h1>
        <i class="fa fa-user"></i>
        <i class="fa fa-check"></i> <br/>
        สมัคสมาชิกสำเร็จ
    </h1>
    <h3>
        เข้าสู่ระบบเพื่อสั่งซื้อสินค้า
    </h3>
    <br/>
    <h4>
        ทางเว็บไซต์ของเราต้องขอขอบพระคุณที่ท่านให้ความสนใจ
    </h4>
    <br/>
    <h4>
        หวังว่าท่านจะมีความสุขและพึงพอใจในกับการซื้อสินค้าจากเว็บไซต์ของเรา
    </h4>
    <br/><br/>
    <?php $web = new Configweb_model(); ?>

    <center>
        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $web->get_logoweb(); ?>"/><br/>
        <h4><?php echo $web->get_webname(); ?></h4>
    </center>
</div>
