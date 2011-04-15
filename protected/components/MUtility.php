<?php
/**
 * some simple functions that helps the developer life
 */
class MUtility
{
	/**
	 * returns a well formatted string that can be useful for
	 * URL-s username etc ...
	 *
	 * @param $str string
	 * @return string
	 */
	public static function strToPretty( $str )
	{
			$retval = strtolower( $str );
			return trim(preg_replace(array('/[^a-z0-9-]/', '/-+/'), array('-','-'), $retval), '-');
	}

	public static function twitterMe( $str )
	{
		if( strpos( $str, '@' ) === 0 )
		{
			return '<a href="http://twitter.com/' . substr( $str, 1, strlen($str) ) . '" target="_blank">' . str_replace( '@', CHtml::image( Yii::app()->request->baseUrl . '/images/twitter-bird.gif' ) . ' ', $str ) . '</a>';
		}

		return $str;
	}
}
