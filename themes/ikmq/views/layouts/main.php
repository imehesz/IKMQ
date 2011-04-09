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
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Play', 'url'=>array('/game/play')),
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
<h2>Archives</h2>
<ul>
<li><a href="#">February 2010</a></li>
<li><a href="#">January 2010</a></li>
<li><a href="#">December 2009</a></li>
</ul>

<br />

<h2>Categories</h2>
<ul>
<li><a href="#">Tutorials</a></li>
<li><a href="#">Articles</a></li>
<li><a href="#">Resources</a></li>
<li><a href="#">Inspiration</a></li>
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
