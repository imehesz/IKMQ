<?php
class GenerateJsonCommand extends CConsoleCommand {
	public function getHelp()
	{
		return <<<EOD
USAGE
  generatejson

DESCRIPTION
  generates a JSON output from the existing movies and quotes
EOD;
	}

	public function run( $args ) {
		$movies = Movie::model()->findAll();
		$json_movies = array();

		if( $movies ) {
			foreach( $movies as $movie ) {
				// we only care about movies that have more than 1 quote!
				if( count( $movie->quotes ) > 1 ) {
					$json_movie = new stdClass;
					$json_movie->id = md5( $movie->title . $movie->year . time() . rand(0,time()) );
					$json_movie->title = $movie->title;
					$json_movie->year = $movie->year;
					$json_movie->image = $movie->pic;
					$json_movie->quotes = array();

					foreach( $movie->quotes as $quote ) {
						$json_quote = new stdClass;
						$json_quote->id = md5( $movie->title . time() . $quote->quote . rand(0,time()) );
						$json_quote->quote = $quote->quote;
						$json_movie->quotes[] = $json_quote;
					}
					$json_movies[] = $json_movie;
				}
			}

			echo CJSON::encode( $json_movies );
		}
	}
}
