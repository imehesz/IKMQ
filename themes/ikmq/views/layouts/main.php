<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<link rel="stylesheet" type="text/css" href="iehacks.css" />
		<![endif]-->
		<!--[if lte IE 7]>
			<link rel="stylesheet" type="text/css" href="ie67hacks.css" />
		<![endif]-->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ikmq.js"></script>
</head>
<body>
<div>&nbsp;</div>
<header>
	<div id="logo">
		<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/ikmq.jpg" alt="Logo" /></a>
<!--<hgroup>
<h1>Webtint</h1>
<h2>Web Development Blog</h2>
</hgroup>-->
</div>

<nav>
		<?php 
            $play_item = 
                ( Yii::app()->controller->id == 'game' && Yii::app()->controller->action->id == 'play' ) ?
                array( 'label' => 'Pause', 'url' => array( '/game/pause' ) ) :
                array( 'label' => 'Play', 'url' => array( '/game/play' ) );

            $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'class' => 'active' ),
                $play_item,
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Hall Of Fame', 'url'=>array('/game/hof')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
			),
		)); ?>

</nav>
</header>
<div id="content">
	<section class="hfeed">
		<?php echo $content; ?>
		<?php /*
		<article class="hentry">
			<hgroup>
				<h2 class="entry-title"><a href="#">The Title</a></h2>
				<h3>Posted by <a class="author" href="#">Johnny</a> on <abbr class="updated published" title="20100228T15:08:00">February 28th</abbr></h3>
			</hgroup>

			<p class="entry-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque feugiat hendrerit ante ut sagittis. Fusce blandit interdum tellus, non ornare massa luctus id. Proin lectus libero, dignissim sit amet dignissim in, facilisis sit amet tellus. Aenean sed felis a justo ultrices facilisis. Sed vehicula sagittis consequat. Donec iaculis lacinia augue eu aliquam. Vestibulum aliquet erat quis felis venenatis a ullamcorper diam semper. Donec vel neque quis sem fermentum tincidunt ac in mi. Pellentesque auctor consectetur justo, eu fermentum urna volutpat sit amet. Suspendisse lacus tellus, porta sed condimentum et, elementum vel diam. Donec at massa neque. Sed lobortis feugiat metus, tincidunt dignissim quam convallis sed.</p>

			<footer><a href="#">Comment on this (5)</a>&emsp;&bull;&emsp;<a href="#">Tweet this</a>&emsp;&bull;&emsp;<a href="#">Stumble Upon</a></footer>			
			<br /><hr /><br />
		</article>

		<article class="hentry">
			<hgroup>
				<h2 class="entry-title"><a href="#">The Title</a></h2>
				<h3>Posted by <a class="author" href="#">Johnny</a> on <abbr class="updated published" title="20100228T15:08:00">February 28th</abbr></h3>
			</hgroup>

			<p class="entry-summary">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque feugiat hendrerit ante ut sagittis. Fusce blandit interdum tellus, non ornare massa luctus id. Proin lectus libero, dignissim sit amet dignissim in, facilisis sit amet tellus. Aenean sed felis a justo ultrices facilisis. Sed vehicula sagittis consequat. Donec iaculis lacinia augue eu aliquam. Vestibulum aliquet erat quis felis venenatis a ullamcorper diam semper. Donec vel neque quis sem fermentum tincidunt ac in mi. Pellentesque auctor consectetur justo, eu fermentum urna volutpat sit amet. Suspendisse lacus tellus, porta sed condimentum et, elementum vel diam. Donec at massa neque. Sed lobortis feugiat metus, tincidunt dignissim quam convallis sed.</p>

			<footer><a href="#">Comment on this (5)</a>&emsp;&bull;&emsp;<a href="#">Tweet this</a>&emsp;&bull;&emsp;<a href="#">Stumble Upon</a></footer>			

			<br /><hr /><br />
		</article>
		*/ ?>
	</section>

<aside>
<?php if( ! Yii::app()->user->isGuest  ) : ?>
	<h2>Admin</h2>
	<ul>
		<li><?php echo CHtml::link( 'Add Movie', Yii::app()->controller->createUrl( 'movie/create' ) ); ?></li>
		<li><?php echo CHtml::link( 'Add Quote', Yii::app()->controller->createUrl( 'quote/create' ) ); ?></li>
		<li><?php echo CHtml::link( 'Logout', Yii::app()->controller->createUrl( '/site/logout' ) );?></li>
	</ul>
<?php endif; ?>

<?php if( Yii::app()->controller->id == 'game' ) : ?>
    <h2>Game</h2>
    <ul>
        <li><b>Your Name:</b> 
            <a href="javascript:void(0);" id="player-name-span-wrapper" title="click to edit"><?php echo $this->anonymous->name; ?></a>
            <span id="player-name-input-wrapper" style="display:none;float:right;">
                <?php echo CHtml::textField( 'player-new-name', $this->anonymous->name, array( 'size' => '10' ) ); ?>
                <?php echo CHtml::button( 'Save', array( 'id' => 'player-update-button' ) ); ?>
                <?php echo CHtml::button( 'Close', array( 'id' => 'player-cancel-button' ) ); ?>
            </span>
			<div style="clear:both;"></div>
         </li>
        <li><b>Level:</b> <?php echo number_format( $this->anonymous->level );?></li>
        <li><b>Score:</b> <?php echo number_format( $this->anonymous->score ); ?></li>
		<?php if( Yii::app()->controller->action->id == 'play' ) : ?>
        <li><b title="Answered in this round">Answered:</b> <span id="answered_so_far">0</span>/<?php echo $this->level; ?></li>
        <li id="preparation-countdown">
            <b>Wait</b> <span>10</span> seconds to start <?php /*<b>or</b>
            <?php echo CHtml::button( '  Start NOW  ', array( 'id' => 'startnow', 'onclick' => 'javascript:showQuotes();' ) );?>
            */ ?>
        </li>
        <li id="final-countdown" style="display:none;">
            <b>Wait</b> <span><?php echo $this->level*5; ?></span> seconds <b>or</b> send your answers <?php echo CHtml::button( ' NOW ', array( 'id' => 'gobutton' ) ); ?>
        </li>
		<?php endif; ?>
    </ul>
<?php endif; ?>
<h2>Top5 by Level</h2>
<ul>
<?php 
	$top5_level_players = AnonymousUser::model()->findAll( array( 'order' => 'level DESC', 'limit' => 5 ) );
	if( $top5_level_players )
	{
		foreach( $top5_level_players as $player )
		{
			echo '<li><div class="top5-player-name">' . MUtility::twitterMe( $player->name ) . '</div><div class="top5-player-score">' .  number_format( $player->level ) . '</div></li>';
		}
	}
?>
</ul>

<h2>Top5 by Score</h2>
<ul>
<?php 
	$top5_level_players = AnonymousUser::model()->findAll( array( 'order' => 'score DESC', 'limit' => 5 ) );
	if( $top5_level_players )
	{
		foreach( $top5_level_players as $player )
		{
			echo '<li><div class="top5-player-name">' . MUtility::twitterMe( $player->name ) . '</div><div class="top5-player-score">' .  number_format( $player->score ) . '</div></li>';
		}
	}
?>
</ul>
<h2>Social</h2>
<ul>
	<li><?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/twitter-bird.gif' ) . ' Twitter', 'http://twitter.com/iknowmyquotes', array( 'target' => '_blank' ) ); ?></li>
	<li><?php echo CHtml::link( CHtml::image( Yii::app()->request->baseUrl . '/images/facebook_icon.png' ) . ' Facebook', 'http://facebook.com/pages/IKMQ/210513355644472', array( 'target' => '_blank' ) ); ?></li>
</ul>
	<h2>Like Us!</h2>
<ul>
	<li>
<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FIKMQ%2F210513355644472&amp;width=220&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=350" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:220px; height:350px;" allowTransparency="true"></iframe>
	</li>
</ul>
<br />
</aside>
</div>
		<div style="clear:both;"></div>
		<footer id="main-footer">
			<section id="footer-1">
				<?php echo CHtml::link( 'Mehesz LLC', 'http://mehesz.net', array( 'target' => '_blank' )); ?> &copy; <?php echo date( 'Y', time() ); ?>
			</section>

			<section id="footer-2">
				Design by <?php echo CHtml::link( 'Webtint', 'http://webtint.net/filebank/html5css3/', array( 'target' => '_blank' ) ); ?>
			</section>
		</footer>
	</body>
</html>
