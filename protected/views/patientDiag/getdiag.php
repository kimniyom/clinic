<?php
$diag = Diag::model()->findAll('');
?>

<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>
<style type="text/css">
    #tbdiag tbody tr td{
        padding: 2px;
    }
</style>
<div class="row" style=" margin: 0px;">
    <div class="col-lg-1" style=" padding-top: 5px;">หัตถการ</div>
    <div class="col-lg-3">
        <select id="diaginsert" class="easyui-combobox" name="dept" style=" width: 100%;">
            <?php foreach ($diag as $d): ?>
                <option value="<?php echo $d['diagcode'] ?>"><?php echo $d['diagname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-lg-2">
        <button type="button" onclick="Adddiag()" class="easyui-linkbutton" data-options="iconCls:'icon-add'">เพิ่ม</button>
    </div>
</div>

<table class="table table-bordered table-striped" style=" margin-top: 10px;" id="tbdiag">
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdiag as $rs): $i++;
            $url = Yii::app()->createUrl('service/detail', array("patient_id" => $rs['patient_id'], "diagcode" => $rs['diag']));
            ?>
            <tr>
                <td style=" text-align: center;"><?php echo $i ?></td>
                <td><?php
                    $diagcode = $rs['diag'];
                    echo Diag::model()->find("diagcode = '$diagcode' ")['diagname'];
                    ?></td>
                <!--
                <td style="text-align: center;">
                    <!--
                    <button type="button" class="btn btn-info btn-xs" onclick="PopupCenter('<?php //echo $url     ?>', 'Service')">
                        บันทึกการรักษา
                    </button>
                    
                </td>
                -->
                <td style=" text-align: center; width: 5%;">
                    <a href="javascript:deletediag('<?php echo $rs['id'] ?>')"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script type="text/javascript">
    function Adddiag() {
        var url = "<?php echo Yii::app()->createUrl('patientdiag/adddiag') ?>";
        var patient_id = $("#patient_id").val();
        var diag = $("#diaginsert").val();
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
