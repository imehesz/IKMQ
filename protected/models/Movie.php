<?php

/**
 * This is the model class for table "movies".
 *
 * The followings are the available columns in table 'movies':
 * @property integer $id
 * @property string $title
 * @property string $year
 * @property integer $created
 */
class Movie extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Movie the static model class
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
		return 'movies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('pic', 'length', 'max'=>100),
			array('year', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, year, created', 'safe', 'on'=>'search'),
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
			'quotes'	=> array( self::HAS_MANY, 'Quote', 'movie_id' ),
			'quoteCnt'	=> array( self::STAT, 'Quote', 'movie_id' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'year' => 'Year',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year,true);
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
				$this->created = time();
			}

			return true;
		}
	}
}
