<style type="text/css">
    #t_hover tbody tr{
        /*color: #66cc00;*/
    }
        #t_hover tbody tr td{
        padding: 1px;
    }
    #t_hover tbody tr:hover{
        background: #e6e6e6;
        /*color: #ffcc00;*/
    }
    #t_hover{
        border: none;
        margin-top: 0px;
    }
</style>
<?php
$web = new Configweb_model();
?>
<table class="table" id="t_hover">
    <tbody>
        <?php
        $i = 0;
        foreach ($service as $rs):
            $i++;
            $url = Yii::app()->createUrl('historyservice/historyresult', array("service_id" => $rs['id']));
            ?>
            <tr onclick="javasript:PopupCenter('<?php echo $url ?>', 'ประวัติการรับบริการ')" style=" cursor: pointer;">
                <td style=" text-align: center; display: none;"><?php echo $i ?></td>
                <td style=" text-align: center;">วันที่ : <?php echo $web->thaidate($rs['service_date']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>






