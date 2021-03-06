<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

    /**
     * anonymous  
     * 
     * @var mixed
     * @access public
     */
    public $anonymous;

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init()
	{
		parent::init();

		$is_cookie = ! isset(Yii::app()->request->cookies['ikmq_exp']);
		//if( ! array_key_exists( 'ikmq_exp', $_COOKIE ) )
		if( $is_cookie )
		{
			// TODO stupid? tell me about it ...
			// if( empty( $_COOKIE['ikmq_exp'] ) )
			{
				//setcookie( 'ikmq_exp', 1, time() + 86400 );
				$cookie = new CHttpCookie('ikmq_exp', 1 );
				$cookie->expire = time()+86400; 
				Yii::app()->request->cookies['ikmq_exp'] = $cookie;

				//Yii::app()->request->cookies['ikmq_exp'] = new CHttpCookie('ikmq_exp',1 );

				session_start();
				session_regenerate_id( true );
				session_destroy();
				unset($_SESSION);
				session_start();
			}
		}
		
        // TODO this is just temporary until we come up with a 
        // better way to track users ...
        $anonymous = AnonymousUser::model()->find( 'session_id=:session_id', array( ':session_id' => Yii::app()->session->sessionID ) );

        if( ! $anonymous )
        {
            $anonymous = new AnonymousUser();
            $anonymous->save();
        }
        $this->anonymous = $anonymous;

		$cs = Yii::app()->clientScript;
		$cs->registerScript( 'basepath', 'var basepath="' . Yii::app()->request->baseUrl  . '";', CClientScript::POS_HEAD );
		$cs->registerScript( 'gamepath', 'var gamepath="' . $this->createUrl( '/game' )  . '";', CClientScript::POS_HEAD );

		Yii::app()->clientScript->registerCoreScript('jquery');
	}
}
