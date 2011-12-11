<div id="maincontent">
<h2>Toplista</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'cssFile' => Yii::app()->theme->baseUrl . '/css/grid.css',
	'dataProvider'=>$topscore,
	'summaryText' => '',
	'columns'=>array(
			array(
				'name' 	=> 'Név',
				//'value'	=> 'strpos($data->name,"@") === 0 ? MUtility::twitterMe( $data->name ) : substr($data->name,0,20)',
				'value' => 'CHtml::link( (strpos( $data->name, "@" ) ? substr( $data->name, 0, strpos($data->name, "@" ) ) : $data->name ), Yii::app()->controller->createUrl( "/profile/view", array( "id" => $data->id ) ) )',
				'type'	=> 'raw',
				'sortable'	=> false,
			),
			array(
				'name'	=> 'Pontszám',
				'value'	=> 'number_format( $data->score )',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
			array(            // display 'create_time' using an expression
				'name'=>'Játszott',
				'value'=>'date("M j", $data->created)',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
		),
	));
?>

</div>
