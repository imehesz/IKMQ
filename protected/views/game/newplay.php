<?php
	Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createUrl( '/game/ajaxcheck' ) . "'", CClientScript::POS_HEAD );

?>

<div>
<div class="label-wrapper">
	<?php if( isset( $is_correct ) && $is_correct ) : ?>
		<span class="label success">your answer was correct</span>
	<?php elseif( isset( $is_correct ) && $is_correct === false ) : ?>
		<span class="label important">your answer was not correct</span>
	<?php endif ?>
</div>
	<?php echo CHtml::beginForm( null, 'post', array( 'id' => 'quote-answer-form' ) ); ?>
		<?php
			echo CHtml::hiddenField( 'quote_id', $quote->id );
			echo CHtml::hiddenField( 'movie_id' );
			echo CHtml::hiddenField( 'ticktack', time() );
			echo CHtml::hiddenField( 'rendered_movies_list', $model->rendered_movies_list );
		?>
		<div class="play-area-wrapper">
			<div class="quote-wrapper">
				<?php echo $quote->quote ?>
			</div>
			<?php echo CHtml::image( Yii::app()->request->baseUrl . '/images/pickone.png' ) ?>
			<?php foreach( $model->movies as $movie ) : ?>
				<div class="movie-wrapper" id="movie_<?php echo $movie->id ?>">
					<?php
						echo CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=120&height=175&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $movie->pic, null, array( 'title' => $movie->title, 'width' => 120, 'height' => 175 ) ) . ' '; 
					?>
					<div class="movie-title">
						<?php echo $movie->title ?>
					</div>
				</div>
			<?php endforeach ?>
			<div style="clear:both;"></div>
		</div>
	<?php echo CHtml::endForm(); ?>
</div>

<script language="javascript">
	jQuery(document).ready(function()
	{
		jQuery('.movie-wrapper').click(function(){
			jQuery('.movie-wrapper').each(function(){
				jQuery('#' + this.id ).css({'background-color':'#fff'})
			});
			jQuery('#' + this.id ).css({'background-color':'#ddd'});
			raw_movie_id = this.id
			movie_id = raw_movie_id.replace('movie_', '')
			if( movie_id > 0 )
			{
				jQuery('#movie_id').val( movie_id )
				jQuery('#quote-answer-form').submit()
			}
		});

		document.location.href="#navigation";
	});
</script>
