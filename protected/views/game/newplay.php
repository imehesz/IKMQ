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


<?php if( ! YII_DEBUG) : ?>

	<div style="text-align:center;" id="ad_holder_on_play">
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-1319358860215477";
		/* ikmq - middle */
		google_ad_slot = "9677305935";
		google_ad_width = 468;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>

	<script>
		var t=setInterval("jQuery('#ad_holder_on_play').html( jQuery('#ad_holder_on_play').html() );",10000);
	</script>
<?php endif ?>
