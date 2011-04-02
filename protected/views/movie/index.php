<?php
$this->breadcrumbs=array(
	'Movies',
);

$this->menu=array(
	array('label'=>'Create Movie', 'url'=>array('create')),
	array('label'=>'Manage Movie', 'url'=>array('admin')),
);
?>

<h1>Movies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
