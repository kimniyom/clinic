<?php 
$config = new Configweb_model();
?>
<div class="list-group">
    <?php foreach($history as $rs): ?>
    <a href="" class="list-group-item" style=" border-radius: 0px; border-left: none; border-right: 0px; color: #406702; font-size: 12px;">
        <?php echo $config->thaidate($rs['service_date']) ?>
        <span class="badge"><?php echo $rs['branchname'] ?></span>
    </a>
    <?php endforeach; ?>
</div>
