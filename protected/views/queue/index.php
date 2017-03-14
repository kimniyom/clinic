<style type="text/css">
    table{
        background: #FFFFFF;
    }
</style>

<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คิวการรักษา',
);

$WebConfig = new Configweb_model();
?>

<div class=" pull-right"><h4>วันที่ : <?php echo $WebConfig->thaidate(date("Y-m-d")) ?></h4></div>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td style=" width: 5%; text-align: center;">#</td>
            <td>ชื่อ - สกุล</td>
            <td style=" text-align: center;">อายุ</td>
            <td style=" text-align: center;">รหัสบัตรประชาชน</td>
            <td>อาการที่มารักษา</td>
            <td style=" text-align: center;">ให้บริการ</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($seq as $rs):
            $i++;
            if ($i == 1) {
                $icon = '<i class="fa fa-arrow-right"></i>';
                $color = 'red';
            } else {
                $icon = '';
                $color = '';
            }
            ?>
            <tr style="color: <?php echo $color ?>;">
                <td style=" text-align:center;"><?php echo $icon . ' ' . $rs['id'] ?></td>
                <td><?php echo $rs['name'] . ' ' . $rs['lname'] ?></td>
                <td style=" text-align:center;"><?php echo $rs['age'] ?></td>
                <td style=" text-align: center;"><?php echo $rs['card'] ?></td>
                <td><?php echo $rs['comment'] ?></td>
                <td style=" text-align: center;">
                    <?php if ($i == 1) { ?>
                        <a href="<?php echo Yii::app()->createUrl('doctor/patientview',array('id' => $rs['patient_id'])) ?>">
                            <button type="button" class="btn btn-default btn-xs">ให้บริการ</button>
                        </a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-default btn-xs disabled">ให้บริการ</button>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

