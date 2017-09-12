<?php
/* @var $this PatientContactController */
/* @var $model PatientContact */
$p = Patient::model()->find("id = '$id'");
$this->breadcrumbs=array(
	'Patient'=>array('patient/index'),
	$p['name'] . ' ' . $p['lname']=>array('patient/view','id'=>$model->patient_id),
	'Update',
);

?>

<h1>แก้ไขข้อมูลที่อยู่ <?php echo $p['name'].' '.$p['lname']; ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model,'id' => $id)); ?>