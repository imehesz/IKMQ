<?php
/*
$this->breadcrumbs=array(
	'Quotes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Quote', 'url'=>array('index')),
	array('label'=>'Manage Quote', 'url'=>array('admin')),
);
*/
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div style="font-size:11px;width:250px;margin-left:10px;">
	<b>Latest Quotes:</b>
	<div id="latest-quotes-wrapper" class="row">
		loading ...
	</div>
</div>

<?php Yii::app()->clientScript->registerScript( 'quotepath', 'var quotepath="' . Yii::app()->controller->createUrl( '/quote' ) . '";', CClientScript::POS_HEAD ) ?>
<?php 
	$lastmid = 
		Yii::app()->request->getParam('lastmid', null ) ? 
			Yii::app()->request->getParam('lastmid'):
			Movie::model()->find( array( 'order'=>'title' ) )->id;

	Yii::app()->clientScript->registerScript( 'updatelatestcode', 'updateLatestQuotes(' . $lastmid . ');', CClientScript::POS_END );
?>
