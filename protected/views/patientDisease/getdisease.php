
<div class="row">
    <div class="col-lg-10">
        <input type="text" id="disease" class="form-control"/>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-success btn-block" onclick="Adddisease()">เพิ่ม</button>
    </div>
</div>
<hr/>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>โรคประจำตัว</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdisease as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['disease']; ?></td>
                <td style=" text-align: center;">
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
        var disease = $("#disease").val();
        if(disease == ""){
            $("#disease").focus();
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
