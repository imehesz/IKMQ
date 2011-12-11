<div id="maincontent">

<div id="emailinfo"><p>
<b>Üdv!</b> Amennyiben már Hancúr Párbaj társas tulajdonosa vagy, akkor a rendeléskor megadott e-mail címedet add meg játékos névnek, ezzel leszel azonosítva. Semmi pánik, a @ utáni rész nem írjuk ki!
</p></div>

<h1 id="player-name-h1">
	<?php //echo strpos($model->name,"@") === 0 ? MUtility::twitterMe( $model->name ) : substr($model->name,0,20) ?>
	<?php echo strpos( $model->name, '@' ) ? substr( $model->name, 0, strpos($model->name,"@") ) : $model->name ?>
	<?php if( $this->anonymous->id == $model->id ) : ?>
		<span id="player-name-span-wrapper" class="edit-instant"><?php echo CHtml::link(Yii::t( 'global', 'átnevez' ), '#' ) ?></span>
	<?php endif ?>
</h1>


<?php if( $this->anonymous->id == $model->id ) : ?>
	<div>
		<span id="player-name-input-wrapper" style="display:none;">
		<?php echo CHtml::textField( 'player-new-name', ( strpos( $this->anonymous->name, '@' ) ? substr( $this->anonymous->name, 0, strpos( $this->anonymous->name, '@' ) ) : $this->anonymous->name ), array( 'size' => '15', 'style' => 'font-size:16px;' ) ); ?>
		<?php echo CHtml::button( 'Elment', array( 'id' => 'player-update-button' ) ); ?>
		<?php echo CHtml::button( 'Mégse', array( 'id' => 'player-cancel-button' ) ); ?>
		</span>
		<div style="clear:both;"></div>
	</div>
<?php endif ?>


<hr />
<table width="100%">
	<tr valign="top">
		<td width="200px">
			<div class="profile-percent" title="<?php echo Yii::t( 'global', 'Pontosság' ) ?>">
			<?php
				if( $model->good_answers > 0 || $model->bad_answers > 0 )
				{
					echo( round( $model->good_answers / ( $model->good_answers + $model->bad_answers ) * 100 ) );
				}
				else
				{
					echo 0;
				}
			?>%
			</div>
		</td>

		<td rowdiv="2">
			<div class="profile-stat"><div class="profile-stat-label"><?php echo Yii::t( 'global', 'Pontszám' )?></div><?php echo number_format( $model->score ) ?></div>
		</td>
	</tr>
</table>
</div>
