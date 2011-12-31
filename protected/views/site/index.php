<?php Yii::app()->clientscript->registerScriptFile( Yii::app()->request->baseUrl . '/js/jquery.tweet.js', CClientScript::POS_END ) ?>
<?php Yii::app()->clientscript->registerCssFile( Yii::app()->request->baseUrl . '/css/tweet.css' ) ?>
<?php Yii::app()->clientscript->registerScript( 'twitterscript', <<<TWEET
jQuery(function($){
	$(".tweet").tweet({
		join_text: "auto",
		username: "I_Know_Quotes",
		avatar_size: 48,
		count: 5,
		auto_join_text_default: "",
		auto_join_text_ed: "we",
		auto_join_text_ing: "we were",
		auto_join_text_reply: "we replied",
		auto_join_text_url: "we were checking out",
		loading_text: "loading tweets..."
	});
});
TWEET
, CClientScript::POS_READY ) ?>

<?php $this->pageTitle=Yii::app()->name; ?>
<?php $welcomes = array( 'Hello', 'Hello there', 'Welcome', 'Howdy', 'Hey', 'Hey there' ); ?>
<p>
<h1><?php echo $welcomes[ rand(0,sizeof( $welcomes )-1 ) ];?> Stranger!</h1>
</p>
<p>Congratulations! You, through the miraculous ways of the Internet, actually found us!</p>

<p>So what is this? What are we doing here? It is a simple <b>online movie trivia game</b>. Nothing more, nothing less. It helps you to feel good about yourself ... <b>if you know movies and movie quotes</b>. And who doesn't?</p>

<p>So, if you don't like to play or you don't like movies, please kindly ... <i>GET OUT OF HERE!</i></p>

<p><b>If you are ready</b>, head over to the <?php echo CHtml::link( 'about page', Yii::app()->createUrl( '/site/page', array( 'view' => 'about' ) ) ); ?> and read the rules.</p>

<p><i>IKQ team</i></p>

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

<hr />

<div style="text-align:center;">
	<?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/twitter-ani.gif', 'I Know Quotes' ), 'http://twitter.com/I_Know_Quotes', array( 'target' => '_blank' ) ) ?>
</div>

<p>
<div class="tweet"> </div>
</p>
