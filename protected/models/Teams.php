<?php

/**
 * This is the model class for table "{{teams}}".
 *
 * The followings are the available columns in table '{{teams}}':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $forum
 * @property string $irc
 * @property string $twitter
 * @property string $facebook
 * @property string $facebookid
 * @property string $banner
 * @property string $slug
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property Chapters[] $chapters
 * @property Users $updatedBy
 * @property Users $createdBy
 * @property TeamsMembers[] $teamsMembers
 */
class Teams extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{teams}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, slug', 'required'),
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name, url, forum, irc, twitter, facebook, facebookid, slug', 'length', 'max'=>255),
			array('banner, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, url, forum, irc, twitter, facebook, facebookid, banner, slug, created_at, created_by, updated_at, updated_by', 'safe', 'on'=>'search'),
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
			'chapters' => array(self::HAS_MANY, 'Chapters', 'team_id'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'teamsMembers' => array(self::HAS_MANY, 'TeamsMembers', 'team_id'),
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
			'url' => 'Url',
			'forum' => 'Forum',
			'irc' => 'Irc',
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'facebookid' => 'Facebookid',
			'banner' => 'Banner',
			'slug' => 'Slug',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('forum',$this->forum,true);
		$criteria->compare('irc',$this->irc,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('facebookid',$this->facebookid,true);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('slug',$this->slug,true);
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
	 * @return Teams the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
