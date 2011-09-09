<?php

/**
 * This is the model class for table "quotes".
 *
 * The followings are the available columns in table 'quotes':
 * @property integer $id
 * @property integer $movie_id
 * @property string $quote
 * @property integer $level
 * @property integer $created
 */
class Quote extends CActiveRecord
{
	public $level;
	public $movies;
	public $movies_shuffled;
	public $quotes;
	public $rendered_movies_list;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Quote the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quotes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('movie_id,quote', 'required'),
			array('movie_id, level, created', 'numerical', 'integerOnly'=>true),
			array('quote', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, movie_id, quote, level, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'movie'		=> array( self::BELONGS_TO, 'Movie', 'movie_id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'movie_id' => 'Movie',
			'quote' => 'Quote',
			'level' => 'Level',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('movie_id',$this->movie_id);
		$criteria->compare('quote',$this->quote,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		if( parent::beforeSave() )
		{
			if( $this->isNewRecord )
			{
				$this->level	= 1;
				$this->created 	= time();
			}

			return true;
		}
	}

	public function buildGame( $level = 1 )
	{
		$this->level = $level;

		$criteria 			= new CDbCriteria;
		$criteria->order	= strstr( Yii::app()->db->connectionString, 'sqlite' ) ? 'random()' : 'rand()';
		//$criteria->limit 	= $this->level*2;
		$criteria->limit 	= 3;
		$this->movies		= Movie::model()->findAll( $criteria );

		$this->movies_shuffled = $this->movies;
		shuffle( $this->movies_shuffled );
	}

	public function buildNewGame( $level = 1 )
	{
		$this->level = $level;
		$criteria 			= new CDbCriteria;
		$criteria->order	= strstr( Yii::app()->db->connectionString, 'sqlite' ) ? 'random()' : 'rand()';
		$criteria->limit	= 3;
		$this->movies 		= Movie::model()->findAll( $criteria );
		$this->movies_shuffled = $this->movies;
		shuffle( $this->movies_shuffled );
		$rendered_movies	= array();
		foreach( $this->movies_shuffled as $movie )
		{
			$rendered_movies[] = $movie->id;
		}

		$this->rendered_movies_list = implode( ',', $rendered_movies );
	}
}
