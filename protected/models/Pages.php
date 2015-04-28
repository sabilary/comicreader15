<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property integer $id
 * @property integer $chapter_id
 * @property integer $sort
 * @property string $filename
 * @property string $mime
 * @property integer $size
 * @property integer $height
 * @property integer $width
 * @property integer $hidden
 * @property string $slug
 * @property string $lastseen
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $views
 *
 * The followings are the available model relations:
 * @property Chapters $chapter
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chapter_id, sort, filename, slug', 'required'),
			array('chapter_id, sort, size, height, width, hidden, created_by, updated_by, views', 'numerical', 'integerOnly'=>true),
			array('mime', 'length', 'max'=>255),
			array('lastseen, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, chapter_id, sort, filename, mime, size, height, width, hidden, slug, lastseen, created_at, created_by, updated_at, updated_by, views', 'safe', 'on'=>'search'),
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
			'chapter' => array(self::BELONGS_TO, 'Chapters', 'chapter_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'chapter_id' => 'Chapter',
			'sort' => 'Sort',
			'filename' => 'Filename',
			'mime' => 'Mime',
			'size' => 'Size',
			'height' => 'Height',
			'width' => 'Width',
			'hidden' => 'Hidden',
			'slug' => 'Slug',
			'lastseen' => 'Lastseen',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
			'views' => 'Views',
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
		$criteria->compare('chapter_id',$this->chapter_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('mime',$this->mime,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('hidden',$this->hidden);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('lastseen',$this->lastseen,true);
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
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
