<?php
	Yii::app()->clientScript->registerScript( 'gamecontrollerpath', "var gamecontrollerpath='" . Yii::app()->controller->createAbsoluteUrl( '/game/' ) . "'", CClientScript::POS_HEAD );
?>

<div id="ajax-play-panel">loading ...</div>

<script>
	var updateAjaxPlayPanel = function()
	{
		$.ajax({
			url: gamecontrollerpath + "/ajaxnewplay",
			context: document.body,
			success: function( data ){
				if( data != 'fail' )
				{
					jQuery('#ajax-play-panel').html( data );
				}
			}
		});
	}

	jQuery(document).ready(function(){
		updateAjaxPlayPanel();
	});
</script>
