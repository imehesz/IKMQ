<?php

class ProfileController extends Controller
{
	public function actionView( $id )
	{
		$model = $this->loadModel( $id );
		$this->render('view', array( 'model' => $model ));
	}

	public function loadModel($id)
	{
		$model = AnonymousUser::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
