<?php
	Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createUrl( '/game/ajaxcheck' ) . "'", CClientScript::POS_HEAD );

?>

<div>
	<?php echo CHtml::beginForm( null, 'post', array( 'id' => 'quote-answer-form' ) ); ?>
		<?php
			echo CHtml::hiddenField( 'quote_id', $quote->id );
			echo CHtml::hiddenField( 'movie_id' );
			echo CHtml::hiddenField( 'ticktack', time() );
			echo CHtml::hiddenField( 'rendered_movies_list', $model->rendered_movies_list );
		?>
		<div style="padding-left:70px;text-align:center;">
			<div style="width:500px;">
				<h1 style="line-height:35px;"><?php echo $quote->quote ?></h1>
			</div>
			<?php foreach( $model->movies as $movie ) : ?>
				<div class="movie-wrapper" id="movie_<?php echo $movie->id ?>" style="float:left; height:195px;width:150px;text-align:center;margin:5px;padding-top:15px;border:1px solid #ddd;">
					<?php
						echo CHtml::image( 
							Yii::app()->request->baseUrl . 
								'/image.php?width=120&height=175&image='. Yii::app()->request->baseUrl . '/' . Yii::app()->params['moviescreenshots'] . $movie->pic, null, array( 'title' => $movie->title ) ) . ' '; 
					?>
				</div>
			<?php endforeach ?>
			<div style="clear:both;"></div>
		</div>
		<?php echo CHtml::submitButton( 'lock in those quotes' ) ?>
	<?php echo CHtml::endForm(); ?>

	<?php
		$this->widget(
				'ext.ETooltip.ETooltip', 
				array(
					"selector" => "#quote-answer-form img[title]",
					"tooltip"=>array(
						'opacity'	=> 1
						),
					'image'	=> 'black_small.png'
				)
		);
	?>
</div>

<script language="javascript">
	jQuery(document).ready(function()
	{
		jQuery('.movie-wrapper').click(function(){
			jQuery('.movie-wrapper').each(function(){
				jQuery('#' + this.id ).css({'background-color':'#fff'})
			});
			jQuery('#' + this.id ).css({'background-color':'#aaa'});
			raw_movie_id = this.id
			movie_id = raw_movie_id.replace('movie_', '')
			if( movie_id > 0 )
			{
				jQuery('#movie_id').val( movie_id )
			}
		});
	});
</script>
