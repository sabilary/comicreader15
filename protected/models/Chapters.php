<?php

/**
 * This is the model class for table "{{chapters}}".
 *
 * The followings are the available columns in table '{{chapters}}':
 * @property integer $id
 * @property integer $series_id
 * @property integer $sort
 * @property string $title
 * @property string $description
 * @property string $cover
 * @property integer $hidden
 * @property string $slug
 * @property string $uniqueid
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $views
 *
 * The followings are the available model relations:
 * @property Archives[] $archives
 * @property Users $createdBy
 * @property Series $series
 * @property Users $updatedBy
 * @property Pages[] $pages
 */
class Chapters extends CActiveRecord
{
    public $cover_img;
	public $remove_img;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{chapters}}';
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
			array('title', 'length', 'max'=>128),
            array('title', 'unique'),
			array('cover_img', 'length', 'max'=>255),
            array('cover_img', 'file', 'types'=>'pdf, jpg, png', 'maxSize'=>1024 * 1024 * 5, 'tooLarge'=>'File size max 5MB', 'allowEmpty'=>true),
			array('series_id, description, cover, hidden, sort, slug, uniqueid, created_at, created_by, updated_at, updated_by, views, remove_img', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, series_id, sort, title, description, cover, hidden, slug, uniqueid, created_at, created_by, updated_at, updated_by, views', 'safe', 'on'=>'search'),
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
			'archives' => array(self::HAS_MANY, 'Archives', 'chapter_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'series' => array(self::BELONGS_TO, 'Series', 'series_id'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
			'pages' => array(self::HAS_MANY, 'Pages', 'chapter_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'series_id' => 'Series',
			'sort' => 'Sort',
			'title' => 'Title',
			'description' => 'Description',
			'cover' => 'Cover',
			'hidden' => 'Visibility',
			'slug' => 'Slug',
            'uniqueid' => 'Uniqueid',
			'created_at' => 'Posted At',
			'created_by' => 'Posted By',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
			'views' => 'Views',
            
            'remove_img'=>'Remove Cover',
            'cover_img'=>'Upload Cover',
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
		$criteria->compare('series_id',$this->series_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('hidden',$this->hidden);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('uniqueid',$this->uniqueid,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('views',$this->views);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Chapters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
