<?php
/* @var $this AlertController */
/* @var $model Alert */

$this->breadcrumbs=array(
	'แจ้งเตือน',
);

?>

<h1>แจ้งเตือน </h1>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>