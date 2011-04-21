<h1>About</h1>
<p>
	<h3>How to play</h3>
</p>
<p>
	The playing "field" is devided into 3 areas + 1 menu:
	<ol>
		<li><strong>Play/Pause</strong> menu is probably the most important. You can start and stop the game with that button, at your convenience. Once you paused a game and returned to play, the game will continue on your level.<br /><br /></li>
		<li><strong>Quotes</strong> - these are the sentences you'll have to recognise from various movies. They will be hidden for <strong>10 seconds</strong>, this is your <strong>"preparation time"</strong>,  so you can hover over the movie pictures and see their title. After the quotes are shown, you have <strong>5 seconds</strong> to find the right movie for <strong>each quote</strong>.<br /><br /></li>
		<li><strong>Movies</strong> - at the beginning you will see 3 columns, in the first column you have <i>grey boxes</i>, this is where you have to drop the right movie from the other 2 columns. <strong>Please note</strong>, that the movies can be anywhere in those 2 columns not necessarily in the same row as the quote!<br /><br /></li>
		<li><strong>Game Stats</strong> on the right where you can change your name, see your level, your score and the answered questions so far on this page. If you are fast enough you can also submit your answers earlier.</li>
	</ol>
</p>
<p>
	<?php echo CHtml::image( Yii::app()->request->baseUrl . '/images/ikmq_final.jpg'  ); ?>
</p>
<p>
	<h3>FAQ</h3>
</p>
<p><u>Is it free?</u> - <b>YES</b> it is comletely and a <b>100% FREE</b></p>
<p><u>Registration?</u> - You probably hate registration, so do we. There is absolutely <b>NO REGISTRATION</b>. We don't care about your email address, we don't care about your phone number. Of course if you would like to tell us something, <?php echo CHtml::link( 'contact us', $this->createUrl( 'site/contact' ) ); ?>.</p>

<p>If you really want the people to know you, you can enter your <?php echo CHtml::link( 'twitter', 'http://twitter.com', array( 'target' => '_blank' ) ); ?> account, and try to get into the <b>TOP5</b>.</p>

<?php if( ! YII_DEBUG ) : ?>
<table width="100%">
	<tr>
		<td>
			<iframe src="http://rcm.amazon.com/e/cm?t=mehesznet-20&o=1&p=12&l=ur1&category=dvd&banner=1SDQVA1DWHAHX2JQR782&f=ifr" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
		</td>
		<td>
			<iframe src="http://rcm.amazon.com/e/cm?t=mehesznet-20&o=1&p=12&l=ur1&category=musicandentertainmentrot&f=ifr" width="300" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
		</td>

	</tr>
</table>
<?php endif; ?>
