
<div class="row">
    <div class="col-lg-10">
        <input type="text" id="drug" class="form-control"/>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-success btn-block" onclick="Adddrug()">เพิ่ม</button>
    </div>
</div>
<hr/>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>อาการแพ้ยา</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdrug as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['drug']; ?></td>
                <td style=" text-align: center;">
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
        var drug = $("#drug").val();
        if(drug == ""){
            $("#drug").focus();
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
