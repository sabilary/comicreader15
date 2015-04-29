<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $pass
 * @property string $email
 * @property integer $role_id
 * @property string $avatar
 * @property integer $activated
 * @property integer $banned
 * @property string $ban_reason
 * @property string $last_ip
 * @property string $last_login
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 *
 * The followings are the available model relations:
 * @property Archives[] $archives
 * @property Archives[] $archives1
 * @property Chapters[] $chapters
 * @property Chapters[] $chapters1
 * @property Pages[] $pages
 * @property Pages[] $pages1
 * @property Series[] $series
 * @property Series[] $series1
 * @property Teams[] $teams
 * @property Teams[] $teams1
 * @property TeamsMembers[] $teamsMembers
 * @property TeamsMembers[] $teamsMembers1
 * @property TeamsMembers[] $teamsMembers2
 * @property Threads[] $threads
 * @property Threads[] $threads1
 * @property ThreadsComments[] $threadsComments
 * @property ThreadsComments[] $threadsComments1
 * @property Users $updatedBy
 * @property Users[] $users
 * @property UsersRoles $role
 */
class Users extends CActiveRecord
{
	// COSTUM VARIABLES
	public $passwordSave;
	public $repeatPassword;
	public $avatarpic;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// USERNAME
			array('username', 'required'),
			array('username', 'unique'),
			array('username', 'length', 'min'=>3, 'max'=>20),
			array('username', 'match' , 'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=> 'Username can contain only alphanumeric characters and hyphens(-).'),
			
			// PASSWORD
			array('pass', 'safe'),
			array('passwordSave, repeatPassword', 'required', 'on'=>'insert'),
			array('passwordSave, repeatPassword', 'length', 'min'=>3, 'max'=>20),
			array('passwordSave', 'compare', 'compareAttribute'=>'repeatPassword'),
			//array('passwordSave', 'checkStrength', 'score'=>20),
			
			// EMAIL
			array('email', 'required'),
			array('email', 'email'),
			array('email', 'unique'),
			array('email', 'length', 'min'=>3, 'max'=>50),
			
			// AVATAR
			array('avatar', 'safe'),
			array('avatarpic', 'length', 'max'=>200),
			array('avatarpic', 'file', 'types'=>'jpg, png', 
				'maxSize'=>1024 * 1024 * 1, 
				//'tooLarge'=>'Ukuran file maksimal 1MB', 
				'allowEmpty'=>true, 
				'on'=>'updatefoto',
			),
			array('avatarpic', 'safe', 'on'=>'insert'),
            
			array('role_id', 'required'),
            array('ban_reason', 'checkBanned'),
			array('activated, banned, last_ip, last_login, created_at, updated_at, updated_by', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, pass, email, role_id, activated, avatar, banned, ban_reason, last_ip, last_login, created_at, updated_at, updated_by', 'safe', 'on'=>'search'),
		);
	}
    
    public function checkBanned() {        
         if($this->banned == true) {
            if(empty($this->ban_reason))
               $this->addError("ban_reason", 'Ban reason cannot be blank.');
         }
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'archives' => array(self::HAS_MANY, 'Archives', 'created_by'),
			'archives1' => array(self::HAS_MANY, 'Archives', 'updated_by'),
			'chapters' => array(self::HAS_MANY, 'Chapters', 'created_by'),
			'chapters1' => array(self::HAS_MANY, 'Chapters', 'updated_by'),
			'pages' => array(self::HAS_MANY, 'Pages', 'created_by'),
			'pages1' => array(self::HAS_MANY, 'Pages', 'updated_by'),
			'series' => array(self::HAS_MANY, 'Series', 'created_by'),
			'series1' => array(self::HAS_MANY, 'Series', 'updated_by'),
			'teams' => array(self::HAS_MANY, 'Teams', 'updated_by'),
			'teams1' => array(self::HAS_MANY, 'Teams', 'created_by'),
			'teamsMembers' => array(self::HAS_MANY, 'TeamsMembers', 'updated_by'),
			'teamsMembers1' => array(self::HAS_MANY, 'TeamsMembers', 'created_by'),
			'teamsMembers2' => array(self::HAS_MANY, 'TeamsMembers', 'user_id'),
			'threads' => array(self::HAS_MANY, 'Threads', 'created_by'),
			'threads1' => array(self::HAS_MANY, 'Threads', 'updated_by'),
			'threadsComments' => array(self::HAS_MANY, 'ThreadsComments', 'updated_by'),
			'threadsComments1' => array(self::HAS_MANY, 'ThreadsComments', 'created_by'),
			'updatedBy' => array(self::BELONGS_TO, 'Users', 'updated_by'),
			'users' => array(self::HAS_MANY, 'Users', 'updated_by'),
			'role' => array(self::BELONGS_TO, 'UsersRoles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'pass' => 'Pass',
			'email' => 'E-mail',
			'role_id' => 'Role',
			'avatar' => 'Avatar',
			'activated' => 'Activated',
			'banned' => 'Banned',
			'ban_reason' => 'Ban Reason',
			'last_ip' => 'Last Ip',
			'last_login' => 'Last Login',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'updated_by' => 'Updated By',
            
			'passwordSave' => 'Password',
			'repeatPassword' => 'Repeat Password',
			'avatarpic' => 'Avatar',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('activated',$this->activated);
		$criteria->compare('banned',$this->banned);
		$criteria->compare('ban_reason',$this->ban_reason,true);
		$criteria->compare('last_ip',$this->last_ip,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('created_at',$this->created_at,true);
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
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    // HASH PASSWORD
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }
	
    // VALIDATE PASSWORD
	public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->pass);
    }
    
    // BEFORE SAVE
	public function beforeSave() {
		parent::beforeSave();
		//add the password hash if it's a new record
		if ($this->isNewRecord) {
			$this->pass = $this->hashPassword($this->passwordSave); 
			$this->created_at = new CDbExpression("NOW()");
		
		} else if (
			!empty($this->passwordSave)&&!empty($this->repeatPassword)&&($this->passwordSave===$this->repeatPassword)
		) {
			//if it's not a new password, save the password only if it not empty and the two passwords match
			$this->pass = $this->hashPassword($this->passwordSave);
		}
		return true;
	}
}