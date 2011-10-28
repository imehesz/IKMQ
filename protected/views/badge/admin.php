<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'badge-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'level',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
