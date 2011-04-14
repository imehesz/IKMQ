<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>HTML5 and CSS3 Layout</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<link rel="stylesheet" type="text/css" href="iehacks.css" />
		<![endif]-->
		<!--[if lte IE 7]>
			<link rel="stylesheet" type="text/css" href="ie67hacks.css" />
		<![endif]-->
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
				array('label'=>'Home', 'url'=>array('/site/index')),
                $play_item,
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
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
	</ul>
<?php endif; ?>

<?php if( Yii::app()->controller->id == 'game' ) : ?>
    <h2>Game</h2>
    <ul>
        <li><b>Your Name:</b> <?php echo $this->anonymous->name ;?></li>
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
			echo '<li><div class="top5-player-name">' . $player->name . '</div><div class="top5-player-score">' .  number_format( $player->level ) . '</div></li>';
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
			echo '<li><div class="top5-player-name">' . $player->name . '</div><div class="top5-player-score">' .  number_format( $player->score ) . '</div></li>';
		}
	}
?>
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
