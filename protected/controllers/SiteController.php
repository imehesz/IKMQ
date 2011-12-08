<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionFacebookShare()
	{
		$badge = null;

		// the latest badge, we don't care if they share it 
		// even multiple times.
		if( ! $badge )
		{
			$badge_found = AssocUserBadge::model()->find( 'user_id=:user_id', array( ':user_id' => $this->anonymous->id ) );
			if( $badge_found )
			{
				$badge = Badge::model()->findByPk( $badge_found->badge_id );
			}
		}

		if( $badge )
		{
			// we need to get the last badge by this user, because 
			// that's what we're gonna show on the facebook page

			Yii::import( 'ext.facebook.fb.src.*' );

			$app_id = Yii::app()->params['facebook']['app_id'];
			$app_secret = Yii::app()->params['facebook']['app_secret'];

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
					</script>;
EOT;

					exit;
			}

			// Do the wall post.
			$facebook->api("/me/feed", "post", array(
        		'messawge' => Yii::t('global', "I just received the `{badge_name}` badge on http://IKnowQuotes.com", array( '{badge_name}' => strtoupper( $badge->name ) ) ),
        		'picture' => Yii::app()->request->baseUrl . '/images/badges/' . $badge->picture,
       			'link' => $this->createAbsoluteUrl( '/profile/view', array( 'id' => $this->anonymous->id ) ),
       			'name' => 'IKQ - I Know Quotes',
       			'caption' => 'IKQ - I Know Quotes'
			));

			echo <<< EOT2
			<script type="text/javascript">
					window.close();
			</script>;
EOT2;
			Yii::app()->end();

		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: info@mehesz.net\r\nReply-To: info@mehesz.net";
				mail(Yii::app()->params['adminEmail'],'Email from IKMQ: ' . $model->subject,'Email: ' . $model->email . "\r\n\r\nMessage: \r\n" . $model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
