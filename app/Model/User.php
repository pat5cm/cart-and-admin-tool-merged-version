<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class User extends AppModel {
    
      public $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'message' => 'First name must not be empty',
        ),
        'last_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Last name must not be empty',
        ),
         'username'=> array(
            'rule1'=>array(
                'rule' => 'notEmpty',
                'message'=>'Username must not be empty'
                ),
            'rule2'=>array(
                'rule' => 'isUnique',
                'message'=>'Username is not unique'
            )
        ),
         'email' => array(
            'rule1'=>array(
                'rule' => 'notEmpty',
                'message'=>'Email must not be empty'
                ),
            'rule2'=>array(
                'rule' => 'isUnique',
                'message'=>'Email is not unique'
                ),
            'rule3'=>array(
                'rule' => 'email',
                'message'=>'Email is not valid'
                )
        ),
         'password' => array(
            'rule' => 'notEmpty',
            'message' => 'Password must not be empty',
        ), 
    );
    
    //Hash a password with the application's salt value before saving to database
    public function beforeSave($options = array()) {
		if(isset($this->data[$this->name]['password'])) {
			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);
		}
		return true;
	}
    
}
?>
