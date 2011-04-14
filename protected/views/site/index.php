<?php $this->pageTitle=Yii::app()->name; ?>
<?php $welcomes = array( 'Hello', 'Hello there', 'Welcome', 'Howdy', 'Hey', 'Hey there' ); ?>
<h1><?php echo $welcomes[ rand(0,sizeof( $welcomes )-1 ) ];?> Stranger!</h1>
<p>
</p>
<p>Congratulations! You, through the miraculous ways of the Internet, actually found us!</p>

<p>So what is this? What are we doing here? It is a simple <b>online game</b>. Nothing more, nothing less. It helps you to feel good about yourself ... <b>if you know movies and movie quotes</b>. And who doesn't?</p>

<p>So, if you don't like to play or you don't like movies, please kindly ... <i>GET OUT OF HERE!</i></p>

<p><b>If you are ready</b>, head over to the <?php echo CHtml::link( 'about page', Yii::app()->createUrl( '/site/page', array( 'view' => 'about' ) ) ); ?> and read the rules.</p>

<p>
	<b>FAQ</b>
</p>
<p><u>Is it free?</u> - <b>YES</b> it is comletely and a <b>100% FREE</b></p>
<p><u>Registration?</u> - You probably hate registration, so do we. There is absolutely <b>NO REGISTRATION</b>. We don't care about your email address, we don't care about your phone number, we don't care who you are.</p>

<p>If you really want the people to know you, you can enter your <?php echo CHtml::link( 'twitter', 'http://twitter.com', array( 'target' => '_blank' ) ); ?> account, and try to get into the <b>TOP5</b>.</p>
