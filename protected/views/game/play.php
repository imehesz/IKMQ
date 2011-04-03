<?php
$this->breadcrumbs=array(
	'Game'=>array('/game'),
	'Play',
);

	Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createUrl( '/game/ajaxcheck' ) . "'", CClientScript::POS_HEAD );

?>
<h1>PLAY</h1>

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
				<?php echo $movie->quotes[ $rand_qoute ]->quote; ?><br /><?php echo $movie->quotes[$rand_qoute]->movie_id; ?>
			</td>
			<td>
				<div class="movie-droppable"></div>
				<?php echo CHtml::textField( 'answer_' . $i, 0, array( 'size' => 2 ) ); ?>
			</td>
			<td><?php 
					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) ) . ' '; 

					echo 
						CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=50&height=75&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $model->movies_shuffled[$rand_movie_cnt]->pic, null, array( 'title' => $model->movies_shuffled[$rand_movie_cnt++]->title ) );
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
						alert( 'heyooo' );
					},
					'cache': false
				});
			}
		);
	});
</script>
