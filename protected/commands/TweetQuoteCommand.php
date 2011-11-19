<?php
	class TweetQuoteCommand extends CConsoleCommand
	{
	    public function getHelp()
        {
                return <<<EOD
USAGE
  tweetquote

DESCRIPTION
	finds a random quote and tweets it

EOD;
        }

		public function run( $args )
		{
			// $quotes = Quote::model()->findAll();
			// we select a quote that is less than 88 chars long and has a title that is less than 20
			// char long, so we can squeeze the whole thing into a TWITTER post, because:
			// "you are noone if you're not on TWITTEEEER"
			$quote = Yii::app()->db->createCommand()
					->select('quote, title')
					->from('quotes q')
					->join('movies m', 'q.movie_id=m.id')
					->where(' length(quote<88) AND length(m.title<20)' )
					->limit(1)
					->order( 'rand()' )
					->queryRow();

			if( $quote )
			{
				$tweet_update = "Quote of the week: \"{$quote['quote']}\" - {$quote['title']}";

				if( strlen( $tweet_update ) <= 117 )
				{
					$tweet_update = $tweet_update . ' #movies #trivia #game';
				}

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
