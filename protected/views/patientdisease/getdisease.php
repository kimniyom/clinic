<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

<style type="text/css">
    #tbdisease tbody tr td{
        padding: 2px;
    }
</style>

<div class="row" style=" margin: 0px;">
    <div class="col-lg-2 col-md-2 col-sm-2" style=" padding-top: 5px;">
        โรคประจำตัว
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
        <input type="text" id="diseaseinsert" class="form-control" placeholder="โรคประจำตัว ..."/>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2" style=" text-align: right;">
        <button type="button" class="btn btn-success btn-block" onclick="Adddisease()"><i class="fa fa-plus"></i>เพิ่ม</button>
    </div>
</div>


<table class="table table-bordered" style=" margin-top: 10px;" id="tbdisease">
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdisease as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td><?php echo $rs['disease']; ?></td>
                <td style=" text-align: center; width: 5%;">
                    <a href="javascript:deletedisease('<?php echo $rs['id']?>')"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    function Adddisease() {
        var url = "<?php echo Yii::app()->createUrl('patientdisease/adddisease') ?>";
        var patient_id = $("#patient_id").val();
        var disease = $("#diseaseinsert").val();
        if(disease == ""){
            $("#diseaseinsert").focus();
            return false;
        }
        var data = {
            patient_id: patient_id,
            disease: disease
        };

        $.post(url, data, function (result) {
           loaddisease();
        });
    }
    
    function deletedisease(id){
        var url = "<?php echo Yii::app()->createUrl('patientdisease/deletedisease') ?>";
        var data = {
            id: id
        };

        $.post(url, data, function (result) {
           loaddisease();
        });
    }
</script>
