var updateLatestQuotes = function( movie_id )
{
	if( movie_id > 0)
	{
		
		jQuery('#latest-quotes-wrapper').html( 'loading ...' );
	 jQuery.ajax({
			url: quotepath + '/ajaxgetlatestquotes?mid=' + movie_id,
			context: document.body,
			success: function( data ){
				if( data != 'fail' )
				{
					jQuery('#latest-quotes-wrapper').html( data );
				}
				else
				{
					jQuery('#latest-quotes-wrapper').html('-');
				}
			}
		});
	}
}

jQuery(document).ready(function(){
    jQuery('body').delegate('#player-name-span-wrapper','click',function( obj ){
        jQuery('#player-name-span-wrapper').hide();
        jQuery('#player-name-h1').hide();
        jQuery('#player-name-input-wrapper').show();

/*
        tid = jQuery(this).attr('id');
        jQuery("#rename-tag-label-wrapper-" + tid ).hide();
        jQuery("#rename-tag-form-wrapper-" + tid ).show().focus();
        jQuery.ajax({
url: tagmoduledefault + 'ajaxrenametag' + '?tid=' + tid + '&tagtobe=' + tagtobe,
context: document.body,
success: function( data ){
if( data == 'success' )
{
// we can have tags in groups, so we just reaload the page
location.href = "";
}
else
{
alert( "Oops! Please try again :/" );
}
}
}); 
*/
    });

    jQuery('body').delegate('#player-update-button','click',function( obj ){
		name = jQuery('#player-new-name').val();

        jQuery.ajax({
			url: gamepath + '/ajaxupdatename?name=' + name,
			context: document.body,
			success: function( data ){
				if( data == 'success' )
				{
			        jQuery('#player-name-input-wrapper').hide();
        			jQuery('#player-name-h1').html( name );
        			jQuery('#player-name-span-wrapper').show();
        			jQuery('#player-name-h1').show();
					window.location.reload();
				}
				else
				{
					alert( "Oops - please try again :/" );
				}
			}
		});
    });


    jQuery('body').delegate('#player-cancel-button','click',function( obj ){
        jQuery('#player-name-input-wrapper').hide();
        jQuery('#player-name-span-wrapper').show();
        jQuery('#player-name-h1').show();
    });
});
