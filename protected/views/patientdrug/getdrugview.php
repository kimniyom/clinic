<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

<style type="text/css">
    #tbdrug tbody tr td{
        padding: 2px;
    }
</style>



<table class="table table-bordered table-striped" style=" margin-top: 10px;" id="tbdrug">
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdrug as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td><?php echo $rs['drug']; ?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



