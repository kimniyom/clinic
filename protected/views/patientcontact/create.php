<?php
/* @var $this PatientContactController */
/* @var $model PatientContact */
$p = Patient::model()->find("id = '$id'");
$this->breadcrumbs = array(
    'Patient' => array('patient/index'),
    $p['name'] . ' ' . $p['lname'] => array('patient/view', 'id' => $id),
    'Create',
);

?>

<h1>เพิ่มข้อมูลติดต่อ <?php echo $p['name'] . ' ' . $p['lname'] ?></h1>
<hr/>
<?php $this->renderPartial('_form', array('model' => $model, 'id' => $id)); ?>