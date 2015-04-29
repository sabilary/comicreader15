<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	* Authenticates a user.
	* Authenticate against our Database
	* @return boolean whether authentication succeeds.
	*/
	private $_id;
    
	public function getId() {
		return $this->_id;
	}
	
	public function authenticate() {
		//$user= Users::model()->find('LOWER(username)=?', array(strtolower($this->username)));
        $user= Users::model()->find('username=?', array($this->username));
		
		if($user === null) {
			$this->errorCode= self::ERROR_UNKNOWN_IDENTITY;
		
		} else if(!$user->validatePassword($this->password)) {
			$this->errorCode= self::ERROR_PASSWORD_INVALID;
			
		} else {
			$this->_id = $user->id;
            $this->setState('roles', $user->role_id);
			
			$user->last_ip = Yii::app()->request->getUserHostAddress();
			$user->last_login = new CDbExpression("NOW()");
			$user->save();
			
			$this->errorCode= self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
}