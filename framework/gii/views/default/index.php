<style type="text/css">
	#m_menu li a{
		color:#000000;
	}
</style>
<h1>Welcome to Yii Code Generator!</h1>

<p>
	You may use the following generators to quickly build up your Yii application:
</p>
<ul id="m_menu">
	<?php foreach($this->module->controllerMap as $name=>$config): ?>
	<li style="color:#000000;"><?php echo CHtml::link(ucwords(CHtml::encode($name).' generator'),array($name.'/index'));?></li>
	<?php endforeach; ?>
</ul>

