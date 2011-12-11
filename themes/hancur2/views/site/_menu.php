<div id="topmenu">
<ul>
	<li><a href="<?php echo Yii::app()->request->baseUrl ?>">Főolal</a></li>
    <li><a href="<?php echo $this->createUrl( '/game/play' ) ?>">JÁTÉK</a></li>
    <li><a href="<?php echo $this->createUrl( '/profile/view', array( 'id' => $this->anonymous->id ) ) ?>">Profil</a></li>
    <li><a href="<?php echo $this->createUrl( '/game/hof' ) ?>">Toplista</a></li>
    <li><a href="<?php echo $this->createUrl( 'site/page', array( 'view' => 'about' ) ) ?>">Játékszabály</a></li>
</ul>
</div>
