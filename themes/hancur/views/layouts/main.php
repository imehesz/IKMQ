<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hancúr Párbaj Játék</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ikmq.js"></script>
</head>
<body>

	<div id="container">
		<?php echo $content ?>
		<!--Menu BTN-->
		<div id="answer1"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/fooldal.png" /></a></div>
		<div id="answer2"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/profil.png" /></a></div>
		<div id="answer3"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/toplista.png" /></a></div>
	</div>
</body>
</html>
