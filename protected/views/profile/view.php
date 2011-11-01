<h1 id="player-name-h1">
	<?php echo strpos($model->name,"@") === 0 ? MUtility::twitterMe( $model->name ) : substr($model->name,0,20) ?>
	<?php if( $this->anonymous->id == $model->id ) : ?>
		<span id="player-name-span-wrapper" class="edit-instant"><?php echo CHtml::link(Yii::t( 'global', 'edit' ), '#' ) ?></span>
	<?php endif ?>
</h1>


<?php if( $this->anonymous->id == $model->id ) : ?>
	<div>
		<span id="player-name-input-wrapper" style="display:none;">
		<?php echo CHtml::textField( 'player-new-name', $this->anonymous->name, array( 'size' => '15', 'style' => 'font-size:22px;' ) ); ?>
		<?php echo CHtml::button( 'Save', array( 'id' => 'player-update-button' ) ); ?>
		<?php echo CHtml::button( 'Close', array( 'id' => 'player-cancel-button' ) ); ?>
		</span>
		<div style="clear:both;"></div>
	</div>
<?php endif ?>


<hr />
<table width="100%">
	<tr valign="top">
		<td width="200px">
			<div class="profile-percent">
			<?php
				if( $model->good_answers > 0 || $model->bad_answers > 0 )
				{
					echo( round( $model->good_answers / ( $model->good_answers + $model->bad_answers ) * 100 ) );
				}
				else
				{
					echo 0;
				}
			?>%
			</div>
		</td>

		<td rowdiv="2">
			<div class="profile-stat"><div class="profile-stat-label"><?php echo Yii::t( 'global', 'Played at' )?></div> <?php echo date( 'M j, g:ia', $this->anonymous->updated ) ?></div>
			<div class="profile-stat"><div class="profile-stat-label"><?php echo Yii::t( 'global', 'Level' )?></div><?php echo $model->level ?></div>
			<div class="profile-stat"><div class="profile-stat-label"><?php echo Yii::t( 'global', 'Score' )?></div><?php echo number_format( $model->score ) ?></div>
		</td>
	</tr>
</table>
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



<h1><?php echo Yii::t( 'global', 'Badges' ) ?></span></h1>
<hr />
<table width="100%">
	<tr>
		<td width="200px">
			<div class="profile-percent"><?php echo $model->badgeCount ?></div>
		</td>
		<td>
			<?php if( AnonymousUser::getNumberOne() && AnonymousUser::getNumberOne()->id == $model->id ) : ?>
				<?php
					$image = 'king.png';
					echo CHtml::image( 
						Yii::app()->request->baseUrl . 
						'/image.php?width=75&height=75&image='. Yii::app()->request->baseUrl . '/images/badges/' . $image , null, array( 'title' => 'KING OF QUOTES', 'width' => 75, 'height' => 75 ) ) . ' '; 
				?>
			<?php endif ?>

			<?php if( $model->badgeCount ) : ?>
				<?php foreach( $model->badges as $badge ) : ?>
					<?php
						$image = $badge->picture ?: 'badge.png';
						echo CHtml::link( CHtml::image( 
							Yii::app()->request->baseUrl . 
							'/image.php?width=75&height=75&image='. Yii::app()->request->baseUrl . '/images/badges/' . $image , null, array( 'title' => $badge->name, 'width' => 75, 'height' => 75 ) ) . ' ', $this->createUrl( '/badge/view', array( 'id' => $badge->id ) ) ); 
					?>

				<?php endforeach ?>
			<?php endif ?>
		</td>
	</tr>
</table>
<hr />
