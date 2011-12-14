<?php
class AdminThemeFilter extends CFilter
{
	protected function preFilter( $filterChain )
	{
		Yii::app()->theme = 'classic';
		return true;
	}
}
