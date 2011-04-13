<?php
$this->breadcrumbs=array(
	'Movies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Movie', 'url'=>array('index')),
	array('label'=>'Manage Movie', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
