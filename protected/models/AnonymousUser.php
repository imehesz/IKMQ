<?php

/**
 * This is the model class for table "anonymous_user".
 *
 * The followings are the available columns in table 'anonymous_user':
 * @property integer $id
 * @property string $name
 * @property string $session_id
 * @property integer $level
 * @property integer $score
 * @property integer $created
 * @property integer $updated
 */
class AnonymousUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AnonymousUser the static model class
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
		return 'anonymous_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id', 'required'),
			array('level, score, created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('session_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, session_id, level, score, created, updated', 'safe', 'on'=>'search'),
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
			'badges' 		=> array(self::MANY_MANY, 'Badge', 'assoc_user_badge(user_id, badge_id)'),
			'badgeCount'	=> array(self::STAT, 'Badge', 'assoc_user_badge(user_id, badge_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'session_id' => 'Session',
			'level' => 'Level',
			'score' => 'Score',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('score',$this->score);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    public function beforeValidate()
    {
        parent::beforeValidate();
        $now = time();

        if( $this->isNewRecord )
        {
            $this->created      = $now;
            $this->level        = 1;
            $this->score        = 0;
            $this->session_id   = Yii::app()->session->sessionID;
            $this->name         = strtoupper( substr( $this->session_id,0,6 ) );
        }

        $this->updated = $now;

        return true;
    }

    public function updateLevelScore( $newlevel, $newscore )
    {
        $this->level = $newlevel;
        $this->score = $this->score+$newscore;
        $this->updated = time();
        $this->update();

		// let's check if we have a badge for this level ...
		$badge = Badge::model()->find( 'level=:level', array( ':level' => $newlevel ) );

		if( $badge )
		{
			// if there is already a badge for this user we won't create it again

			$userbadge_exist = AssocUserBadge::model()->findByAttributes( array( 'user_id' => $this->id, 'badge_id' => $badge->id ) );

			if( ! $userbadge_exist )
			{
				// save badge for user ...
				$userbadge = new AssocUserBadge;
				$userbadge->user_id 	= $this->id;
				$userbadge->badge_id	= $badge->id;
				$userbadge->save(); 

				// redirect to the badge view page
				Yii::app()->controller->redirect( Yii::app()->controller->createUrl( '/badge/view', array( 'id' => $badge->id, 'justgotit' => 1 ) ) );
			}

			// redirect to the badge view page
			// Yii::app()->controller->redirect( Yii::app()->controller->createUrl( '/badge/view', array( 'id' => $badge->id, 'justgotit' => 1 ) ) );
		}
    }
}
