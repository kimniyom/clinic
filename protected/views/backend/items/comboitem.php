<select id="itemcode" class="form-control">
    <option value="">== รหัสสินค้า ==</option>
    <?php foreach($itemlist as $rs): ?>
    <option value="<?php echo $rs['itemcode']?>"><?php echo $rs['itemcode'] ?></option>
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
