<select id="itemcode" class="form-control">
    <option value="">== รหัสสินค้า ==</option>
    <?php foreach($itemlist as $rs): ?>
    <option value="<?php echo $rs['product_id']?>"><?php echo $rs['product_id']."(".$rs['product_name'].")" ?></option>
    <?php endforeach;?>
</select>

<script type="text/javascript">
    $(document).ready(function () {
        $("#itemcode").select2({
            placeholder: "Select a State",
            allowClear: true
        });
    });
</script>
