<style type="text/css">
    .img-store{
        border: #339900 solid 2px;
    }

    #con-img ul {
        list-style-type: none;
    }

    #con-img ul li {
        display: inline-block;
    }

    #con-img input[type="checkbox"][id^="cb"] {
        display: none;
    }

    #con-img label {
        /*
        border: 1px solid #fff;
        padding: 10px;
        */
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
        border: 2px solid #cccccc;
    }

    #con-img label:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        /*border: 1px solid grey;*/
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    #con-img label img {
        /*height: 100px;
        width: 100px;
        */
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
    }

    #con-img :checked + label {
        border:green solid 2px;
    }

    #con-img :checked + label:before {
        content: "✓";
        background-color: green;
        transform: scale(1);
        z-index: 1;
    }

    /*
    #con-img :checked + label img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: -1;
    }
    */

</style>

<div class="row">
    <div id="con-img">
        <ul style=" padding: 0px;">
            <?php
            foreach ($images as $rs):
                ?>
                <li class="col-sm-6 col-md-2 col-lg-2">
                    <input type="checkbox" id="cb<?php echo $rs['id'] ?>" value="<?php echo $rs['images'] ?>"/>

                    <label for="cb<?php echo $rs['id'] ?>">
                        <div class="img-wrapper">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/product/<?php echo $rs['images'] ?>" class="img-responsive article-img" style=" height: 100px;"/>
                        </div>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div id="debugOutput"></div>

<script type="text/javascript">
    function GetvalImg() {
        var checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function (index, elem) {
            checkboxValues.push($(elem).val());
        });
        //$('#debugOutput').html(checkboxValues.join(','));
        var imgVal = checkboxValues.join(',');
        //alert(imgVal);
        var url = "<?php echo Yii::app()->createUrl('backend/product/insertimages') ?>";
        var productID = $("#product_id").val();
        var data = {img: imgVal, product_id: productID};
        $.post(url, data, function (datas) {
            loadimagesProduct();
            $("#popupImages").modal("hide");
        });
    }
</script>





