<?php

/**
 * GameController 
 * 
 * @uses Controller
 * @package 
 * @version $id$
 * @copyright Clevertech
 * @author Imre Mehesz <imre@clevertech.biz> 
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

	public function actionPlay()
	{
		$level = $this->anonymous->level;
        $this->level = $level;

		$game = new Quote;
		$game->buildGame( $level );

        if( ! sizeof( $game->movies ) )
        {
            throw new CHttpException( '500', 'Oops ... seems like we have no movies in the DB :/' );
        }

		$this->render('play', array( 'model' => $game ) );
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
}
