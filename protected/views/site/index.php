<?php $this->pageTitle=Yii::app()->name; ?>
<?php $welcomes = array( 'Hello', 'Hello there', 'Welcome', 'Howdy', 'Hey', 'Hey there' ); ?>
<p>
<h1><?php echo $welcomes[ rand(0,sizeof( $welcomes )-1 ) ];?> Stranger!</h1>
</p>
<p><br /></p>
<p>Congratulations! You, through the miraculous ways of the Internet, actually found us!</p>

<p>So what is this? What are we doing here? It is a simple <b>online game</b>. Nothing more, nothing less. It helps you to feel good about yourself ... <b>if you know movies and movie quotes</b>. And who doesn't?</p>

<p>So, if you don't like to play or you don't like movies, please kindly ... <i>GET OUT OF HERE!</i></p>

<p><b>If you are ready</b>, head over to the <?php echo CHtml::link( 'about page', Yii::app()->createUrl( '/site/page', array( 'view' => 'about' ) ) ); ?> and read the rules.</p>

<p><i>IKMQ team</i></p>

<p>
	<table cellspacing="10">
		<tr>
			<td>
				<?php echo CHtml::image( Yii::app()->request->baseUrl . '/images/advisory.gif' ); ?>
			</td>
			<td>
				Oh, we try to keep it clean, but you know, there are always those <?php echo CHtml::link( 'Tarantino', 'http://en.wikipedia.org/wiki/Quentin_Tarantino', array( 'target' => '_blank' ) ) ?> movies ;)
			</td>
		</tr>
	</table>
</p>
