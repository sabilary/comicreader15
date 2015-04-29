<?php

class WebUser extends CWebUser {
    // Store model to not repeat query.
    private $_model;
    
    // Load user model.
    protected function loadUser() {
        if($this->_model===null)
        {
			$this->_model = Users::model()->findByPk( $this->id );
        }
        return $this->_model;
    }
    
    public function getTheUserName(){
        $user = $this->loadUser();
        return $user->username;
    }
    
    public function getTheRole(){
        $user = $this->loadUser();
        return $user->role_id;
    }
}