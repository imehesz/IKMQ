<?php

class BadgeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array(
				'application.components.AdminThemeFilter + admin,create,update,index'
			)

		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'king', 'viewbyname' ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $justgotit = false )
	{
		$model = $this->loadModel( $id );

		$criteria = new CDbCriteria;
		$criteria->condition 	= 'badge_id=:badge_id';
		$criteria->order 		= 'created DESC';
		$criteria->limit		= 10;
		$criteria->params 		= array( ':badge_id' => $id ); 

		$recently_awarded = AssocUserBadge::model()->findAll( $criteria );

		if( $justgotit )
		{
			$this->renderPartial( 'view',array(
				'model' => $model,
				'justgotit' => true
			));

		}
		else
		{
			$this->render( 'view',array(
				'model' => $model,
				'recently_awarded' => $recently_awarded
			));
		}
	}

	public function actionViewByName( $name, $justgotit=false )
	{
		// it's kinda redundant but will work for now
		if( $name != 'king' )
		{
			$model = Badge::model()->find( 'name=:name', array( ':name' => $name ) );
			if( $model )
			{
				$this->actionView( $model->id, $justgotit );
			}
			else
			{
				throw new CHttpException( '404', "Oops! `$name` badge doesn't exist!" );
			}
		}
		else
		{
			$this->actionKing( $justgotit );
		}
	}

	public function actionKing( $justgotit = true )
	{
		if( $justgotit )
		{
			$this->renderPartial( 'king' );
		}
		else
		{
			// if we got here it means somebody is trying to get to the KING OF THE QUOTES page
			// let's load the Curren't King's profile
			$this->redirect( $this->createUrl( '/profile/view', array( 'id' => AnonymousUser::model()->getNumberOne()->id ) ) );
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Badge;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Badge']))
		{
			$model->attributes=$_POST['Badge'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Badge']))
		{
			$model->attributes=$_POST['Badge'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Badge');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Badge('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Badge']))
			$model->attributes=$_GET['Badge'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Badge::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='badge-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
