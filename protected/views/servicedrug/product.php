
<select id="product" class="form-control" style=" padding: 20px;">
    <?php foreach ($product as $rs): ?>
        <option value="<?php echo $rs['product_id'] ?>"><?php echo $rs['product_name'] ?> (คงเหลือ <?php echo $rs['total']?>)</option>
    <?php endforeach; ?>
</select>

<script type="text/javascript">
    $(document).ready(function(){
       $("#product").select2({
           allowClear: true,
           theme: "bootstrap"
       }); 
    });
</script>