<script type="text/javascript" charset="utf-8"src="<?= Yii::app()->baseUrl; ?>/themes/dortor/assets/jquery-easyui/jquery.easyui.min.js"></script>

<style type="text/css">
    #tbdisease tbody tr td{
        padding: 2px;
    }
</style>

<table class="table table-bordered" style=" margin-top: 10px;" id="tbdisease">
    <tbody>
        <?php
        $i = 0;
        foreach ($patientdisease as $rs): $i++;
            ?>
            <tr>
                <td style=" text-align: center; width: 5%;"><?php echo $i ?></td>
                <td><?php echo $rs['disease']; ?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

