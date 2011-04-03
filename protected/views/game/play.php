<?php
$this->breadcrumbs=array(
	'Game'=>array('/game'),
	'Play',
);

	Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createUrl( '/game/ajaxcheck' ) . "'", CClientScript::POS_HEAD );

?>
<div><strong>GAME STATS</strong></div> 
<div><strong>Level:</strong> <?php echo $model->level; ?> <strong>Answered </strong><span id="answered_so_far">0</span>/<?php echo $model->level; ?></div>

<div>
	<?php echo CHtml::beginForm( null, null, array( 'id' => 'quote-answer-form' ) ); ?>
	<table>
	<?php $rand_movie_cnt=0; for( $i=0; $i < $model->level ; $i++ ): ?>
		<?php		
				$movie = $model->movies[$i];
				
				do{
					$rand_qoute = rand( 0, $movie->quoteCnt );
				}while( ! isset( $movie->quotes[ $rand_qoute ] ) );
		?>
		<tr class="">
			<td class="td-quote">
				<?php echo CHtml::hiddenField( 'quote_'.$i, $movie->quotes[$rand_qoute]->id ); ?>
				<?php echo $movie->quotes[ $rand_qoute ]->quote; ?>
			</td>
			<td>
				<?php
					$this->beginWidget('zii.widgets.jui.CJuiDroppable', array(
						'options'=>array(
							'drop'=>'js:function( event, ui ) {
								raw_answer 	= ui.draggable[0].id;
								movie_id 	= raw_answer.replace( "movie_id_","" );
								hidden_field = event.target.nextElementSibling;
								answer_before = jQuery(hidden_field).val();
								jQuery( hidden_field ).val( movie_id );

								// if there was no answer before, this must be 
								// a brand new "drop" so we increase the answered
								// number :)
								if( answer_before == 0 )
								{
									answered_so_far = parseInt( jQuery("#answered_so_far").text() );
									jQuery( "#answered_so_far" ).text( answered_so_far+1 );
								}
							}', //remember put js:
							)));
																				?>
				<div class="movie-droppable"></div>
				<?php $this->endWidget(); ?>
				<?php echo CHtml::hiddenField( 'answer_' . $i, 0 ); ?>
			</td>
			<td>
				<?php 
				//some draggable object
				$this->beginWidget('zii.widgets.jui.CJuiDraggable',
					array(
						'id'	=> 'movie_id_' . $model->movies_shuffled[$rand_movie_cnt]->id,
						'htmlOptions'=>array(
							'style'=>'float:left;width:50px;height:75px;background:#FFEEEE;margin-right:5px;',
						),
						'options' => array( 'snap' => false )
					 ));
					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) ) . ' '; 

					$this->endWidget();

				$this->beginWidget('zii.widgets.jui.CJuiDraggable',
					array(
						'id'	=> 'movie_id_' . $model->movies_shuffled[$rand_movie_cnt]->id,
						'htmlOptions'=>array(
							'style'=>'float:left;width:50px;height:75px;background:#FFEEEE;margin-right:5px;',
						),
						'options' => array( 'snap' => false )
					 ));

					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) );

					$this->endWidget();
				?></td>
		</tr>
	<?php endfor; ?>
	</table>
	<?php echo CHtml::endForm(); ?>

	<?php echo CHtml::button( '  GO  ', array( 'id' => 'gobutton' ) );?>
</div>

<script language="javascript">
	jQuery(document).ready( function(){
		jQuery('body').delegate(
			'#gobutton', 'click', function(){
				form_values = jQuery('#quote-answer-form').serialize();
				jQuery.ajax({
					'url': gamecontrollerpath + '&' + form_values,
					'success': function(data){
						alert( 'You answered ' + data + ' wrong!' );
					},
					'cache': false
				});
			}
		);
	});
</script>
