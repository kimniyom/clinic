<?php
$diag = Diag::model()->findAll('');
?>
<?php
if ($checkbody == 0) {
    $class = "disabled";
    ?>
    <div class="alert alert-danger" style="text-align: center;">ยังไม่ได้รับการตรวจร่างกาย ... <i class="fa fa-info-circle"></i></div>
    <?php
} else {
    $class = "";
}
?>
<label>หัตถการ</label>
<div class="row">
    <div class="col-lg-10">
        <select id="diag" class="form-control">
            <?php foreach ($diag as $d): ?>
                <option value="<?php echo $d['diagcode'] ?>"><?php echo $d['diagname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-success btn-block" onclick="Adddiag()">เพิ่ม</button>
    </div>
</div>
<hr/>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>หัตถการทางการแพทย์</th>
            <th></th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdiag as $rs): $i++;
            $url = Yii::app()->createUrl('service/detail', array("patient_id" => $rs['patient_id'], "diagcode" => $rs['diag']));
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php
                    $diagcode = $rs['diag'];
                    echo Diag::model()->find("diagcode = '$diagcode' ")['diagname'];
                    ?></td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-info btn-xs <?php echo $class ?>" onclick="PopupCenter('<?php echo $url ?>', 'Service')">
                        บันทึกการรักษา
                    </button>
                </td>
                <td style=" text-align: center;">
                    <a href="javascript:deletediag('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p style=" color: #fb0303; margin-top: 10px;">
    *ต้องทำการตรวจร่างกายก่อนทุกครั้งก่อนจะบันทึกรายการหัตถการ
</p>

<script type="text/javascript">
    function Adddiag() {
        var url = "<?php echo Yii::app()->createUrl('patientdiag/adddiag') ?>";
        var patient_id = $("#patient_id").val();
        var diag = $("#diag").val();
        var data = {
            patient_id: patient_id,
            diag: diag
        };

        $.post(url, data, function (result) {
            loaddiag();
        });
    }

    function deletediag(id) {
        var url = "<?php echo Yii::app()->createUrl('patientdiag/deletediag') ?>";
        var data = {
            id: id
        };

        $.post(url, data, function (result) {
            loaddiag();
        });
    }
</script>
