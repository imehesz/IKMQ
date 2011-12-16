<?php
// bad times, bad measures
$config = require_once dirname( __FILE__ ) . '/protected/config/development.php';
require_once dirname( __FILE__  ) . "/fb/src/Facebook.php";

// it will NOT WORK in a SUBDIRECTORY
if( ! empty( $_SERVER['HTTP_HOST'] ) )
{
	$base_url = $_SERVER['HTTP_HOST'];
}
else
{
	$base_url = 'http://iknowquotes.com/';
}

$app_id = $config['params']['facebook']['app_id'];
$app_secret = $config['params']['facebook']['app_secret'];

$badge_name = $_GET['badge_name'];
$badge_image = $_GET['badge_image'];

if( $badge_name == 'king' )
{
	$badge_name = 'King Of Quotes';
}

// Init facebook api.
$facebook = new Facebook(array(
                                                'appId' => $app_id,
                                                'secret' => $app_secret,
                                                'cookie' => true
                                                ));

// Get the url to redirect for login to facebook
// and request permission to write on the user's wall.
$login_url = $facebook->getLoginUrl(
                                array('scope' => 'publish_stream')
                                );

// If not authenticated, redirect to the facebook login dialog.
// The $login_url will take care of redirecting back to us
// after successful login.
if (! $facebook->getUser()) 
{
        echo <<< EOT
        <script type="text/javascript">
                top.location.href = "$login_url";
        </script>
EOT;

        exit;
}

// Do the wall post.
$facebook->api("/me/feed", "post", array(
        'message' => "I just earned the `" . strtoupper( $badge_name ) . "` badge on http://IknowQuotes.com. Can you?",
        'picture' => $base_url . '/images/badges/' . $badge_image,
        'link' => $base_url . '/badge/' . $badge_name,
        'name' => 'IKQ -' . strtoupper( $badge_name ) . ' BADGE',
        'caption' => "IKQ - I Know Quotes"
));

        echo <<< EOT2
        <script type="text/javascript">
                window.close();
        </script>
EOT2;
