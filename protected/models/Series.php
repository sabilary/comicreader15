<?php

/**
 * This is the model class for table "{{series}}".
 *
 * The followings are the available columns in table '{{series}}':
 * @property integer $id
 * @property string $title
 * @property string $alt_titles
 * @property string $authors
 * @property string $artists
 * @property string $description
 * @property string $cover
 * @property string $tags
 * @property integer $type
 * @property integer $rated
 * @property integer $completed
 * @property integer $hidden
 * @property string $slug
 * @property string $thread_url
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $views
 *
 * The followings are the available model relations:
 * @property Chapters[] $chapters
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class Series extends CActiveRecord
{
    private $_oldTags;
    public $cover_img;
	public $remove_img;
    
	const TYPE_ONGOING = 1;
	const TYPE_ONESHOT = 2;
	const TYPE_ANTHOLOGY = 3;
    const TYPE_DOUJIN = 4;
    
    public function getSeriesTypes() {
		return array(
			self::TYPE_ONGOING=>'OnGoing',
			self::TYPE_ONESHOT=>'One Shot',
			self::TYPE_ANTHOLOGY=>'Anthology',
			self::TYPE_DOUJIN=>'Doujin',
		);
	}
	
	public function getSeriesTypesText() {
		$what = $this->seriesTypes;
		return isset($what[$this->type]) ? $what[$this->type] : "unknown status ({$this->type})";
	}
    
	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
	}

	/**
	 * This is invoked after the record is saved.
     * Using Tag::updateFrequency()
	 */
	protected function afterSave()
	{
		parent::afterSave();
		Tags::model()->updateFrequency($this->_oldTags, $this->tags);
	}
    
    public function afterDelete()
     {
        parent::afterDelete();
        Tags::model()->removeTags(Tags::string2array($this->tags));
     }
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{series}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// TITLE
			array('title, type', 'required'),
			array('title', 'length', 'max'=>128),
            array('title', 'unique'),
			array('alt_titles, authors, artists, thread_url', 'length', 'max'=>250),
			array('cover_img', 'length', 'max'=>255),
            array('cover_img', 'file', 'types'=>'pdf, jpg, png', 'maxSize'=>1024 * 1024 * 5, 'tooLarge'=>'File size max 5MB', 'allowEmpty'=>true),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			array('description, cover, rated, completed, hidden, slug, created_at, created_by, updated_at, updated_by, views, remove_img', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, alt_titles, authors, artists, description, cover, tags, type, rated, completed, hidden, slug, thread_url, created_at, created_by, updated_at, updated_by, views', 'safe', 'on'=>'search'),
		);
	}
    
	/**
	 * Normalizes the user-entered tags.
     * Using Tag::array2string() and Tag::string2array()
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tags::array2string(array_unique(Tags::string2array($this->tags)));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'chapters' => array(self::HAS_MANY, 'Chapters', 'series_id'),
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
			'title' => 'Title',
			'alt_titles' => 'Alternative Titles',
			'authors' => 'Authors',
			'artists' => 'Artists',
			'description' => 'Description',
			'cover' => 'Cover',
			'tags' => 'Tags',
			'type' => 'Type',
			'rated' => 'Rated',
			'completed' => 'Completed',
			'hidden' => 'Hidden',
			'slug' => 'Slug',
			'thread_url' => 'Thread Url',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alt_titles',$this->alt_titles,true);
		$criteria->compare('authors',$this->authors,true);
		$criteria->compare('artists',$this->artists,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cover',$this->cover,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('rated',$this->rated);
		$criteria->compare('completed',$this->completed);
		$criteria->compare('hidden',$this->hidden);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('thread_url',$this->thread_url,true);
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
	 * @return Series the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
