	<div style="background-color:#fdfcdc;">
	<hr />
	<div style="text-align:center;">
		<h3>
				WooHoo! You became #1 and received the KING OF QUOTES badge!
		</h3>

		<?php if( ! YII_DEBUG ) : ?>
			<div>
				<table style="width:100%;" cellspacing=20>
					<tr valign="top">
						<td valign="top" align="right" width="50%">
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo Yii::app()->createAbsoluteUrl( '/profile/view', array( 'id' => $this->anonymous->id ) ) ?>" data-text="I just earned the KING OF QUOTES badge on IKnowQuotes.com! Can you? #movies" data-count="none">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
						</td>
						<td valign="top" align="left" width="50%">
							<?php /*
							<a name="fb_share" share_url="<?php echo $this->createAbsoluteUrl('/profile/view', array( 'id' => Yii::app()->controller->anonymous->id ) )?>">facebook</a> 
							<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>*/ ?>
							<?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/facebook_share.png' ) , 'javascript:void(0)', array( 'onclick' => 'window.open("' .  Yii::app()->request->baseUrl . '/fb.php?badge_name=king&badge_image=king.png","Ratting","width=600,height=300,0,status=0,");', 'name' => 'Facebook Share', 'title' => 'Facebook Share' ) ) ?>

						</td>
					</tr>
				</table>
			</div>
		<?php endif ?>

		<?php echo CHtml::link( 'keep playing', $this->createUrl( '/game/play' ), array('style' => 'font-size:10px;') ) ?>
	</div>
	<hr />
	</div>

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
				$image = 'king.png';
				echo CHtml::image( 
					Yii::app()->request->baseUrl . 
					'/image.php?width=200&height=200&image='. Yii::app()->request->baseUrl . '/images/badges/' . $image , null, array( 'title' => 'King of Quotes', 'width' => 200, 'height' => 200 ) ) . ' '; 
			?>
		</td>
		<td valign="top" width="300px">
			<h1>King of Quotes</h1>
			<p>
				<?php echo Yii::t('global', 'Congrats!<br/><br/> With your current score, <b>{{score}}</b> you are <br /> the <b>KING OF QUOTES</b>!', array( '{{score}}' => number_format( Yii::app()->controller->anonymous->score ) ) ); ?>
			</p>
		</td>
	</tr>
</table>

