<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

<style type="text/css">
    #tbdrug tbody tr td{
        padding: 2px;
    }
</style>

<div class="row" style=" margin: 0px;">
    <div class="col-lg-2" style=" padding-top: 5px;">
        แพ้ยา
    </div>
    <div class="col-lg-8">
        <input type="text" id="druginsert" class="form-control" placeholder="รายละเอียดการแพ้ยา"/>
    </div>
    <div class="col-lg-2" style=" text-align: right;">
        <button type="button" onclick="Adddrug()" class="btn btn-success"><i class="fa fa-plus"></i>เพิ่ม</button>
    </div>
</div>


<table class="table table-bordered table-striped" style=" margin-top: 10px;" id="tbdrug">
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdrug as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td><?php echo $rs['drug']; ?></td>
                <td style=" text-align: center; width: 5%;">
                    <a href="javascript:deletedrug('<?php echo $rs['id']?>')"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    function Adddrug() {
        var url = "<?php echo Yii::app()->createUrl('patientdrug/adddrug') ?>";
        var patient_id = $("#patient_id").val();
        var drug = $("#druginsert").val();
        if(drug == ""){
            $("#druginsert").focus();
            return false;
        }
        var data = {
            patient_id: patient_id,
            drug: drug
        };

        $.post(url, data, function (result) {
           loaddrug();
        });
    }
    
    function deletedrug(id){
        var url = "<?php echo Yii::app()->createUrl('patientdrug/deletedrug') ?>";
        var data = {
            id: id
        };

        $.post(url, data, function (result) {
           loaddrug();
        });
    }
</script>
