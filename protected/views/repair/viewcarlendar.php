<div class="list-group">
    <?php foreach ($repair as $rs): ?>
    <a href="javascript:popuprepair('<?php echo $rs['id'] ?>')" class="list-group-item">
            <label>รายการซ่อม - บำรุง:</label> <?php echo $rs['object'] ?><br/>
            <label>รายละเอียด:</label> <?php echo $rs['detail'] ?>
        </a>
    <?php endforeach; ?>
</div>


