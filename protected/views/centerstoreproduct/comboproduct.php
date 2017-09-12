<select id="product" class="form-control" onchange="Getdetailproduct();">
    <?php foreach ($product as $rs): ?>
        <option value="<?php echo $rs['product_id'] ?>"><?php echo $rs['product_name'] ?></option>
    <?php endforeach; ?>
</select>

<script type="text/javascript">
    Getdetailproduct();
    settexbox();
    $(document).ready(function () {
        $("#product").select2({
            allowClear: true,
            theme: "bootstrap"
        });
    });
    
    function Getdetailproduct(){
        //$("#load_images_product").html("<center><i class=\"fa fa-spinner fa-spin\"></i></center>");
        var url = "<?php echo Yii::app()->createUrl('centerstoreproduct/detailproduct') ?>";
        var productID = $("#product").val();
        var data = {product_id: productID};
        $.post(url, data, function (datas) {
            $("#product_id").val(datas.product_id);
            $("#product_detail").html(datas.detail);
            $("#costs").val(datas.costs);
            $("#product_price").val(datas.price);
            $("#unit").html(datas.unit);
             loadimagesProduct();
        },'json');
    }
    
</script>

