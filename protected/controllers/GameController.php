<?php
/**
 * GameController 
 * 
 * @uses Controller
 * @package 
 * @version $id$
 * @copyright Mehesz.net
 * @author Imre Mehesz <imehesz@gmail.com> 
 * @license PHP Version 5 {@link http://www.php.net/license/3_01.txt}
 */
class GameController extends Controller
{
    /**
     * level 
     * 
     * @var mixed
     * @access public
     */
    public $level;

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPause()
	{
		$this->render( 'pause' );
	}

	public function actionPlay()
	{
		$this->forward( 'newplay' );

		/////////////////////////
		// D E P R E C A T E D //
		/////////////////////////

		$level = $this->anonymous->level;

        // our movies are limited, while the
        // game is technically endless .. so we have to make sure
        // that the GAME level can never surpass the 1/2 of the movies
        // but the users level can!
        $highest_game_level = Movie::model()->count() / 2;
        $this->level = ( $level > $highest_game_level ) ? (int)$highest_game_level : $level;

		$game = new Quote;
		$game->buildGame( $this->level );

        if( ! sizeof( $game->movies ) )
        {
            throw new CHttpException( '500', 'Oops ... seems like we have no movies in the DB :/' );
        }

		$this->render('play', array( 'model' => $game ) );
	}

	public function actionNewPlay()
	{
		$is_correct = null;

		if( ! empty( $_POST ) )
		{
			$quote_id = (int)$_POST['quote_id'];
			$movie_id = (int)$_POST['movie_id'];
			$ticktack = (int)$_POST['ticktack'];
			$points = ( $ticktack - time() + 20 ) * $this->anonymous->level;

			if( $quote_id && $movie_id && $ticktack )
			{
				// let's see if the answer was correct
				$is_correct = Quote::model()->find( 'id=:quote_id AND movie_id=:movie_id', array( ':quote_id' => $quote_id, ':movie_id' => $movie_id ) );
				if( $is_correct )
				{
					// let's add some points and increase the level
					$this->anonymous->updateLevelScore( ($this->anonymous->level+1), $points );
					//$this->render('winning');
				}
				else
				{
					$is_correct = false;
					$this->anonymous->updateLevelScore( ($this->anonymous->level), ( -25*$this->anonymous->level ) );
				}
			}

			//$this->render('fail');
		}

		$game = new Quote;

		$this->level = $this->anonymous->level;
		$game->buildNewGame( $this->level );

		$criteria = new CDbCriteria;
		$criteria->condition = 'movie_id=:movie_id';
		$criteria->params	= array( ':movie_id' => $game->movies[rand(0,2)]->id );
		$criteria->order	= strstr( Yii::app()->db->connectionString, 'sqlite' ) ? 'random()' : 'rand()';
		$quote = Quote::model()->find( $criteria );

		$this->render('newplay', array( 'model' => $game, 'quote' => $quote, 'is_correct' => $is_correct ) );
	}

	public function actionAjaxNewPlay()
	{	
		$is_correct = null;

		if( ! empty( $_POST ) )
		{
			$quote_id = (int)$_POST['quote_id'];
			$movie_id = (int)$_POST['movie_id'];
			$ticktack = (int)$_POST['ticktack'];
			$points = ( $ticktack - time() + 20 ) * $this->anonymous->level;

			if( $quote_id && $movie_id && $ticktack )
			{
				// let's see if the answer was correct
				$is_correct = Quote::model()->find( 'id=:quote_id AND movie_id=:movie_id', array( ':quote_id' => $quote_id, ':movie_id' => $movie_id ) );
				if( $is_correct )
				{
					$this->anonymous->good_answers = $this->anonymous->good_answers + 1;
					// let's add some points and increase the level
					$this->anonymous->updateLevelScore( ($this->anonymous->level+1), $points );
				}
				else
				{
					$is_correct = false;
					$this->anonymous->bad_answers = $this->anonymous->bad_answers + 1;
					$this->anonymous->updateLevelScore( ($this->anonymous->level), (-25*$this->anonymous->level) );
				}
			}
		}

		$game = new Quote;

		$this->level = $this->anonymous->level;
		$game->buildNewGame( $this->level );

		$criteria = new CDbCriteria;
		$criteria->condition = 'movie_id=:movie_id';
		$criteria->params	= array( ':movie_id' => $game->movies[rand(0,2)]->id );
		$criteria->order	= strstr( Yii::app()->db->connectionString, 'sqlite' ) ? 'random()' : 'rand()';
		$quote = Quote::model()->find( $criteria );

		$this->renderPartial( '_ajax_play_panel', array( 'model' => $game, 'quote' => $quote, 'is_correct' => $is_correct ) );
	}

	public function actionAjaxCheck()
	{
		// we have to collect all the answers and
		// figure out if they are good or not
		$get = $_GET;

		// TODO - do this backwards for safety
		// so the bad answers would start off with
		// the level number and would go down
		// with right answers, in that case
		// if something breaks, just in case
		// ppl would not go to the next level ....
		$bad_answers = 0;

		// TODO points needs to multiply by the
		// level. for example:
		// on level 1 user gets 1 point/right answer => so 1 point
		// level 2 user gets 2 points/right answer and so on ... 
		$points = 0;

		foreach( $get as $key => $val )
		{
			if( strstr( $key, 'quote_' ) )
			{
				// if we have the quote, we need to get the ID
				// and the order ID (ie:0,1,2,3) to get the answer associated
				// with it ...
				$order_id = (int)str_replace( 'quote_', '', $key );
				$quote_id = $val;

				$answer_movie_id = $get['answer_'.$order_id];

				if( $answer_movie_id == Quote::model()->findByPk( $quote_id )->movie_id )
				{
					$points += $this->anonymous->level;
				}
				else
				{
					$bad_answers++;
				}
			}
		}

        // if no bad answers, we increase the level
        $bad_answers == 0 ? 
            $this->anonymous->updateLevelScore( ($this->anonymous->level+1), $points ) : 
            $this->anonymous->updateLevelScore( $this->anonymous->level, $points );

		echo $bad_answers;
		die();
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

	public function actionAjaxUpdateName()
	{
		$name = strip_tags( $_GET['name'] );

		// now if we have a name we update our
		// "anonymous" session name ...
		$u = AnonymousUser::model()->find( 'session_id=:session_id', array( 'session_id' => Yii::app()->session->sessionID) );
		if( $u )
		{
			$u->name = $name;
			if( $u->save() )
			{
				die( 'success' );
			}
		}
		die( 'fail' );
	}

	public function actionHof()
	{
		$limit = 15;
		$toplevel = new CActiveDataProvider( 
							'AnonymousUser', 
							array( 
								'criteria' => array( 
									'order' 	=> 'level DESC',
									'condition'	=> 'score>0',
								),
								'pagination' => array(
									'pagesize' => $limit,
								),

							) 
						);

		$topscore = new CActiveDataProvider( 
							'AnonymousUser', 
							array( 
								'criteria' => array( 
									'order' 	=> 'score DESC',
									'condition'	=> 'score>0',
								),
								'pagination' => array(
									'pagesize' => $limit,
								),

							) 
						);

		$this->render( 'hof', array( 'toplevel' => $toplevel, 'topscore' => $topscore ) );
	}
}
