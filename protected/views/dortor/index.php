<style type="text/css">
    #card{
        height: 50px;
        font-size: 30px;
    }
    #bg-patient{
        background: url("images/bg-patient.png") no-repeat right bottom fixed;
        width: 100%;
        height: 100%;
        position: fixed;
        z-index: -1;
    }
</style>
<script>
    $(document).ready(function () {
        $(".breadcrumb").hide();
    });
</script>

<?php $config = new Configweb_model(); ?>
<br/><br/><br/>
<div id="bg-patient"></div>
<h3 class=" text-info"><i class="fa fa-search"></i> ค้นหาข้อมูลลูกค้า</h3>
<div class="well">
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
            <button type="button" class="btn btn-default btn-lg btn-block" onclick="Search()"><i class="fa fa-search"></i> ค้นหา</button>
        </div>
    </div>
</div>
<div id="patient_result"></div>

<script type="text/javascript">
    function Search() {
        var url = "<?php echo Yii::app()->createUrl('dortor/dortorsearch') ?>";
        var card = $("#card").val();
        var data = {card: card};

        if (card == "") {
            $("#card").focus();
            return false;
        }

        $.post(url, data, function (result) {
            if (result == 0) {
                var btn = '<a href="<?php echo Yii::app()->createUrl('patient/index') ?>">'
                        + '<button class="btn btn-default btn-block" style=" border: #cccccc dashed 2px;">'
                        + '<i class="fa fa-plus fa-5x"></i><br/>'
                        + 'ลงทะเบียนลูกค้า'
                        + '</button></a>';
                $("#patient_result").html("<hr/><p style='color:red;text-align:center; font-size:24px;'>ไม่พบข้อมูลลูกค้า</p><br/>" + btn);
            } else {
                $("#patient_result").html(result);
            }
        });
    }
</script>