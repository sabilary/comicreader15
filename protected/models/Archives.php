<?php

/**
 * This is the model class for table "{{archives}}".
 *
 * The followings are the available columns in table '{{archives}}':
 * @property integer $id
 * @property integer $chapter_id
 * @property string $filename
 * @property string $mime
 * @property integer $size
 * @property string $slug
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $lastdownload
 *
 * The followings are the available model relations:
 * @property Chapters $chapter
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class Archives extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{archives}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, slug', 'required'),
			array('chapter_id, size, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('mime', 'length', 'max'=>255),
			array('created_at, updated_at, lastdownload', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, chapter_id, filename, mime, size, slug, created_at, created_by, updated_at, updated_by, lastdownload', 'safe', 'on'=>'search'),
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
			'filename' => 'Filename',
			'mime' => 'Mime',
			'size' => 'Size',
			'slug' => 'Slug',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
			'lastdownload' => 'Lastdownload',
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
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('mime',$this->mime,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('lastdownload',$this->lastdownload,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Archives the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
