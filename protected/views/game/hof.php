<h1>Hall of Fame</h1>

<p>
Here you can see all the players who played so far. 
</p>
<p>
<b>Please note</b>, that every time we upload more movies, the player list will be wiped out (at least until the beta version is up!) and only the <b>TOP 10</b> players will be saved for history.
</p>
<p>
This will give a fair chance to new players.
</p>

<hr />

<h2>By Level</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'cssFile' => Yii::app()->request->baseUrl . '/css/grid.css',
	'dataProvider'=>$toplevel,
	'columns'=>array(
			array(
				'name' 	=> 'name',
				'value'	=> 'strpos($data->name,"@") === 0 ? MUtility::twitterMe( $data->name ) : $data->name',
				'type'	=> 'raw',
				'sortable'	=> false,
			),
			array(
				'name'	=> 'level',
				'value'	=> '$data->level',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
			array(
				'name'	=> 'score',
				'value'	=> 'number_format( $data->score )',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
			array(            // display 'create_time' using an expression
				'name'=>'created',
				'value'=>'date("M j", $data->created)',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
		),
	));
?>

<hr />

<h2>By Score</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'cssFile' => Yii::app()->request->baseUrl . '/css/grid.css',
	'dataProvider'=>$topscore,
	'columns'=>array(
			array(
				'name' 	=> 'name',
				'value'	=> 'strpos($data->name,"@") === 0 ? MUtility::twitterMe( $data->name ) : $data->name',
				'type'	=> 'raw',
				'sortable'	=> false,
			),
			array(
				'name'	=> 'level',
				'value'	=> '$data->level',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
			array(
				'name'	=> 'score',
				'value'	=> 'number_format( $data->score )',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
			array(            // display 'create_time' using an expression
				'name'=>'created',
				'value'=>'date("M j", $data->created)',
				'sortable'	=> false,
				'htmlOptions' => array( 'align' => 'right' )
			),
		),
	));
?>
