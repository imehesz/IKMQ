<h1>About</h1>
<p>
	<h3>How to play</h3>
</p>
<p>
	Welcome to the <b>2.0</b> version. We learned a lot from the 1.0 version, and complitely re-designed the gaming experience, and hopefully made the whole thing more fun.
</p>
<p>
	We think it is so simple, that we don't even explain how to use it. Just click on <b><?php echo CHtml::link( 'PLAY', $this->createUrl( '/game/play' ) ) ?></b> and see it yourself :)'
</p>
<p>
	<h3>FAQ</h3>
</p>
<p><u>Is it free?</u> - <b>YES</b> it is comletely and <b>100% FREE</b></p>
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
