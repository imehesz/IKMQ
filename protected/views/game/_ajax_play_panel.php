<div id="ajax-play-panel-internal">
	<?php
		Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createAbsoluteUrl( '/game/' ) . "'", CClientScript::POS_HEAD );
	?>

	<div class="label-wrapper">
		<?php if( isset( $is_correct ) && $is_correct ) : ?>
			<span class="label success">your answer was correct</span>
		<?php elseif( isset( $is_correct ) && $is_correct === false ) : ?>
			<span class="label important">your answer was wrong</span>
		<?php endif ?>
	</div>

	<!-- new type quote -->
	<div style="background-color:#fdfcdc;">
	<hr />
	<div style="text-align:center;">
		<blockquote>
			<?php echo $quote->quote ?>
		</blockquote>
	</div>
	<hr />
	</div>
	<!-- new type quote -->

	<?php echo CHtml::beginForm( null, 'post', array( 'id' => 'quote-answer-form' ) ); ?>
		<?php
			echo CHtml::hiddenField( 'quote_id', $quote->id );
			echo CHtml::hiddenField( 'movie_id' );
			echo CHtml::hiddenField( 'ticktack', time() );
			echo CHtml::hiddenField( 'rendered_movies_list', $model->rendered_movies_list );
		?>
		<div class="play-area-wrapper">
			<div id="pickone_banner" style="height:60px;overflow:hidden;">
				<?php echo CHtml::image( Yii::app()->request->baseUrl . '/images/pickone.png' ) ?>
			</div>
			<div id="pickone_ad_banner" style="margin:0 auto;display:none;height:60px;overflow:hidden;">
				<script type="text/javascript"><!--
					google_ad_client = "ca-pub-1319358860215477";
					/* ikmq - middle */
					google_ad_slot = "9677305935";
					google_ad_width = 468;
					google_ad_height = 60;
					//-->
				</script>
				<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
			</div>
			<table width="100%">
				<tr>
			<?php foreach( $model->movies as $movie ) : ?>
				<td align="center">
					<div class="movie-wrapper" id="movie_<?php echo $movie->id ?>">
						<div>
							<?php
								echo CHtml::image( 
									Yii::app()->request->baseUrl . 
										'/image.php?width=120&height=175&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $movie->pic, null, array( 'title' => $movie->title, 'width' => 120, 'height' => 175 ) ) . ' '; 
							?>
						</div>
						<div class="movie-title">
							<?php echo $movie->title ?>
						</div>
					</div>
				</td>
			<?php endforeach ?>
			<div style="clear:both;"></div>
			</td>
			</tr>
			</table>
		</div>
	<?php echo CHtml::endForm(); ?>

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
	jQuery('#user_level').html("<?php echo $this->anonymous->level ?>");
	jQuery('#user_score').html("<?php echo number_format( $this->anonymous->score ) ?>");
	var t=setTimeout("jQuery('#pickone_banner').hide();jQuery('#pickone_ad_banner').show();",3000);
</script>
</div>
