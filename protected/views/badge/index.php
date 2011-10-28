<?php
$this->breadcrumbs=array(
	'Badges',
);

$this->menu=array(
	array('label'=>'Create Badge', 'url'=>array('create')),
	array('label'=>'Manage Badge', 'url'=>array('admin')),
);
?>

<h1>Badges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
