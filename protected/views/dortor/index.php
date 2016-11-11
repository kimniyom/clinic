<style type="text/css">
    #card{
        height: 50px;
        font-size: 30px;
    }
</style>
<script>
    $(document).ready(function () {
        $(".breadcrumb").hide();
    });
</script>

<?php $config = new Configweb_model(); ?>
<br/><br/>

<div class="row">
    <div class="col-lg-4">
        <p style=" font-size: 24px; padding-top: 10px; text-align: center;"> เลขบัตรประชาชน 13 หลัก</p>
    </div>
    <div class="col-lg-6">
        <?php
        $this->widget("ext.maskedInput.MaskedInput", array(
            //"model" => $model,
            //"attribute" => "card",
            "id" => 'card',
            "name" => 'card',
            "mask" => '9-9999-99999-99-9',
            "clientOptions" => array("autoUnmask" => true), /* autoUnmask defaults to false */
            "defaults" => array("removeMaskOnSubmit" => false),
                /* once defaults are set will be applied to all the masked fields  removeMaskOnSubmit defaults to true */
        ));
        ?>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="Search()"><i class="fa fa-search"></i> ค้นหา</button>
    </div>
</div>

<div id="patient_result"></div>

<script type="text/javascript">
    function Search() {
        var url = "<?php echo Yii::app()->createUrl('patient/dortorsearch') ?>";
        var card = $("#card").val();
        var data = {card: card};
        
        if(card == ""){
            $("#card").focus();
            return false;
        }
        
        $.post(url, data, function (result) {
            if (result == 0) {
                $("#patient_result").html("<hr/><p style='color:red;text-align:center; font-size:24px;'>ไม่พบข้อมูลลูกค้า</p>");
            } else {
                $("#patient_result").html(result);
            }
        });
    }
</script>