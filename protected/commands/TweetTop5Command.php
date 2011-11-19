<?php
	class TweetTop5Command extends CConsoleCommand
	{
	    public function getHelp()
        {
                return <<<EOD
USAGE
  tweettop5

DESCRIPTION
	finds the Top5 player based on score and Tweets them

EOD;
        }

		public function run( $args )
		{
			// $quotes = Quote::model()->findAll();
			// we find the top5 players for a weekly tweet
			$top5= Yii::app()->db->createCommand()
					->select('name')
					->from('anonymous_user u')
					->limit(5)
					->order( 'score DESC' )
					->queryAll();

			if( $top5 && is_array( $top5 ) )
			{
				$arr_size = sizeof(  $top5 );

				$tweet_update = 'Top5 players of the week: ';
				for( $i=0; $i<$arr_size; $i++ )
				{
					$name = $top5[$i]['name'];
					if( $i == $arr_size-1 )
					{
						$tweet_update .= $name;
					}
					else
					{
						$tweet_update .= $name . ', ';
					}
				}

				$tweet_update .= ' - http://iknowquotes.com #movies #trivia #game';

				$consumer_key           = Yii::app()->params['twitter_consumer_key'];
                $consumer_secret        = Yii::app()->params['twitter_consumer_secret'];
                $oauth_token            = Yii::app()->params['twitter_oauth_token'];
                $oauth_token_secret     = Yii::app()->params['twitter_oauth_token_secret'];

				if( $consumer_key && $consumer_secret && $oauth_token && $oauth_token_secret )
				{
					$tweet = new twitteroauth( $consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret );
					$tweet->post( 'statuses/update', array( 'status' => $tweet_update ) );
				}
			}
		}
	}
