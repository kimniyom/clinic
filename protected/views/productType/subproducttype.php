<script type="text/javascript">
    $(document).ready(function () {
        $("#subproducttype").select2({
            allowClear: true,
            theme: "bootstrap"
        });
    });
</script>

<select id="subproducttype" class="form-control">
    <option value=""> == ทั้งหมด == </option>
    <?php foreach ($type as $rs): ?>
        <option value="<?php echo $rs['id'] ?>"><?php echo $rs['type_name'] ?></option>
    <?php endforeach; ?>
</select>