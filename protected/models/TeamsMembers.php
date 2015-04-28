<?php

/**
 * This is the model class for table "{{teams_members}}".
 *
 * The followings are the available columns in table '{{teams_members}}':
 * @property integer $id
 * @property integer $team_id
 * @property integer $user_id
 * @property integer $requested
 * @property integer $accepted
 * @property integer $team_role_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property Users $updatedBy
 * @property Users $createdBy
 * @property Teams $team
 * @property TeamsRoles $teamRole
 * @property Users $user
 */
class TeamsMembers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{teams_members}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('team_id, user_id', 'required'),
			array('team_id, user_id, requested, accepted, team_role_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, team_id, user_id, requested, accepted, team_role_id, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'team' => array(self::BELONGS_TO, 'Teams', 'team_id'),
			'teamRole' => array(self::BELONGS_TO, 'TeamsRoles', 'team_role_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'team_id' => 'Team',
			'user_id' => 'User',
			'requested' => 'Requested',
			'accepted' => 'Accepted',
			'team_role_id' => 'Team Role',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('team_id',$this->team_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('requested',$this->requested);
		$criteria->compare('accepted',$this->accepted);
		$criteria->compare('team_role_id',$this->team_role_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeamsMembers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
