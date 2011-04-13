<?php
$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Quote', 'url'=>array('index')),
	array('label'=>'Manage Quote', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
