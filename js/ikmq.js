jQuery(document).ready(function(){
//    alert( "yellow" );
    jQuery('body').delegate('#player-name-span-wrapper','click',function( obj ){
        jQuery('#player-name-span-wrapper').hide();
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

    jQuery('body').delegate('#player-cancel-button','click',function( obj ){
        jQuery('#player-name-input-wrapper').hide();
        jQuery('#player-name-span-wrapper').show();
    });
})
