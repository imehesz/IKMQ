<?php

/**
 * This is the model class for table "assoc_user_badge".
 *
 * The followings are the available columns in table 'assoc_user_badge':
 * @property integer $user_id
 * @property integer $badge_id
 * @property integer $created
 *
 * The followings are the available model relations:
 * @property Badge $badge
 * @property AnonymousUser $user
 */
class AssocUserBadge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AssocUserBadge the static model class
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
		return 'assoc_user_badge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, badge_id, created', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, badge_id, created', 'safe', 'on'=>'search'),
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
			'badge' => array(self::BELONGS_TO, 'Badge', 'badge_id'),
			'user' => array(self::BELONGS_TO, 'AnonymousUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'badge_id' => 'Badge',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('badge_id',$this->badge_id);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
	{
		$this->created = time();
		return parent::beforeSave();
	}
}
