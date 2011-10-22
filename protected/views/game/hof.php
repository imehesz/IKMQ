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
				'value'	=> 'strpos($data->name,"@") === 0 ? MUtility::twitterMe( $data->name ) : substr($data->name,0,20)',
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

	<?php if( ! YII_DEBUG ) : ?>
		<div style="text-align:center;">
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-1319358860215477";
			/* ikmq - middle */
			google_ad_slot = "9677305935";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
	<?php endif ?>

<hr />
<h2>By Score</h2>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'cssFile' => Yii::app()->request->baseUrl . '/css/grid.css',
	'dataProvider'=>$topscore,
	'columns'=>array(
			array(
				'name' 	=> 'name',
				'value'	=> 'strpos($data->name,"@") === 0 ? MUtility::twitterMe( $data->name ) : substr($data->name,0,20)',
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
