<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hancúr Párbaj Játék</title>

<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" rel="stylesheet" type="text/css" charset="UTF-8" media="screen, projection" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ikmq.js"></script>

</head>
<body>
	<div id="container">

	<!-- TOP MENU -->
	<?php //include("menu.php"); ?>
		<?php $this->renderPartial( 'webroot.themes.hancur2.views.site._menu' ) ?>
		<?php echo $content ?>
	</div>
</body>
</html>
