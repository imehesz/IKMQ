<!--ANSWER BTN-->
<div id="ajax-play-panel-internal">
	<?php
		Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createAbsoluteUrl( '/game/' ) . "'", CClientScript::POS_HEAD );
	?>

	<?php echo CHtml::beginForm( null, 'post', array( 'id' => 'quote-answer-form' ) ); ?>
		<?php
			echo CHtml::hiddenField( 'quote_id', $quote->id );
			echo CHtml::hiddenField( 'movie_id' );
			echo CHtml::hiddenField( 'ticktack', time() );
			echo CHtml::hiddenField( 'rendered_movies_list', $model->rendered_movies_list );
		?>
		<?php $i=1; foreach( $model->movies as $movie ) : ?>
			<div class="movie-wrapper" id="movie_<?php echo $movie->id ?>">
				<div id="answer<?php echo $i++ ?>">
					<?php
						echo CHtml::image( 
							Yii::app()->request->baseUrl . 
							'/image.php?width=140&height=50&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $movie->pic, null, array( 'title' => $movie->title, 'width' => 140, 'height' => 50 ) ); 
					?>
				</div>
			</div>
		<?php endforeach ?>
	<?php echo CHtml::endForm(); ?>

		<div id="pickone">
			<!--Csak a játéknál!-->
		</div>

		<div id="pickoneanswer">
			<!--Válasz visszajelzések-->
				<?php if( isset( $is_correct ) && $is_correct ) : ?>
					<span class="label success">
						<?php echo CHtml::image( Yii::app()->theme->baseUrl . '/images/answer_good.png' ) ?>
					</span>
				<?php elseif( isset( $is_correct ) && $is_correct === false ) : ?>
					<span class="label important">
						<?php echo CHtml::image( Yii::app()->theme->baseUrl . '/images/answer_wrong.png' ) ?>
					</span>
				<?php endif ?>
		</div>

		<!--MASK-->
		<div id="gamemask"></div>

		<!--IMAGE LOADER-->
		<div id="imageloader">
			<?php if( strstr( $quote->quote, '.jpg' ) || strstr( $quote->quote, '.png' ) || strstr( $quote->quote, '.gif' ) ) : ?>
				<?php 
					echo CHtml::image( 
						Yii::app()->request->baseUrl . 
						'/image.php?width=480&height=550&image='. Yii::app()->request->baseUrl . '/files/quotes/' . trim( $quote->quote ), null ); 

				?>
			<?php else : ?>
				<?php echo $quote->quote ?>
			<?php endif ?>
		</div>
</div>

<script language="javascript">
	jQuery(document).ready(function()
	{
		jQuery('.movie-wrapper').click(function(){
			jQuery('.movie-wrapper').each(function(){
				jQuery('#' + this.id ).css({'background-color':'#fff'})
			});
			jQuery('#' + this.id ).css({'background-color':'#ddd'});
			raw_movie_id = this.id;
			movie_id = raw_movie_id.replace( 'movie_', '' );
			if( movie_id > 0 )
			{

				jQuery('#ajax-play-panel-internal').html( 'loading ...' );
				//jQuery('#movie_id').val( movie_id );
				//jQuery('#quote-answer-form').submit();

				quote_id=<?php echo $quote->id ?>;
				ticktack=<?php echo time() ?>;
				
				$.ajax({
					url: gamecontrollerpath + "/ajaxnewplay",
					context: document.body,
					type: "POST",
					data: "movie_id=" + movie_id + "&quote_id=" + quote_id + "&ticktack=" + ticktack,
					success: function( data ){
						if( data != 'fail' )
						{
							jQuery('#ajax-play-panel-internal').html( data );
						}
					}
				});

			}
		});

		document.location.href="#navigation";
	});
</script>
<script>
	/*
	jQuery('#user_level').html("<?php echo $this->anonymous->level ?>");
	*/
	jQuery('#user_score').html("<?php echo number_format( $this->anonymous->score ) ?>");

	/*
	var t=setTimeout("jQuery('#pickone_banner').hide();jQuery('#pickone_ad_banner').html( jQuery('#ad_holder_on_play').html() );jQuery('#pickone_ad_banner').show();",3000);
	*/
	var t=setTimeout("jQuery('#pickoneanswer').hide();",3000);
</script>

