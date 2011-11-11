<?php if( isset( $justgotit ) && $justgotit ) : ?>
	<div style="background-color:#fdfcdc;">
	<hr />
	<div style="text-align:center;">
		<h3>
				Woot! You've just received the `<?php echo strtoupper( $model->name ) ?>` badge!
		</h3>

		<div>
				<table style="width:100%;" cellspacing=20>
					<tr valign="top">
						<td valign="top" align="right" width="50%">
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo Yii::app()->createAbsoluteUrl( '/badge/viewbyname', array( 'name' => strtolower( $model->name ) ) ) ?>" data-text="Just received the <?php echo strtoupper( $model->name ) ?> badge on IKnowQuotes! <?php echo Yii::app()->createAbsoluteUrl( '/badge/viewbyname', array( 'name' => strtolower( $model->name ) ) ) ?> #movies" data-count="none">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script> 
						</td>
						<td valign="top" align="left" width="50%">
							<a name="fb_share" share_url="<?php echo $this->createAbsoluteUrl('/badge/viewbyname', array( 'name' => strtolower( $model->name ) ) )?>">facebook</a> 
							<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
						</td>
					</tr>
				</table>
		</div>

		<?php echo CHtml::link( 'keep playing', $this->createUrl( '/game/play' ), array('style' => 'font-size:10px;') ) ?>
	</div>
	<hr />
	</div>
<?php endif ?>

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


<table width="650px">
	<tr>
		<td valign="top" width="10px">
			<?php
				$image = $model->picture ?: 'badge.png';
				echo CHtml::image( 
					Yii::app()->request->baseUrl . 
					'/image.php?width=200&height=200&image='. Yii::app()->request->baseUrl . '/images/badges/' . $image , null, array( 'title' => $model->name, 'width' => 200, 'height' => 200 ) ) . ' '; 
			?>
		</td>
		<td valign="top" width="375px">
			<div class="profile-badges"><?php echo $model->name ?></div>
			<p class="badge-descr">
				<?php 
					$this->beginWidget('CMarkdown');
					echo $model->description;
					$this->endWidget(); 
				?>
			</p>
		</td>
	</tr>
</table>

