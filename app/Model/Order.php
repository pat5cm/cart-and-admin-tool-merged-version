<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class Order extends AppModel {
    
    public $validate = array(
        'name' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Name is invalid',
                         ),
                ),
         'email' => array(
			'email' => array(
				'rule' => array('email',true),
				'message' => 'Please supply a valid email address',
			),
		),
        'billing_address' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Billing Address is invalid',

			),
		),
        'billing_city' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Billing City is invalid',
				
			),
		),
		'billing_state' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Billing State is invalid',
				
			),
		),
		'shipping_address' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Shipping Address is invalid',
				
			),
		),
		'shipping_city' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Shipping City is invalid',
				
			),
		),
		'shipping_state' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'Shipping State is invalid',
				
			),
		),
		'creditcard_number' => array(
			'notempty' => array(
				'rule' => array('cc'),
				'message' => 'Credit Card Number is invalid',
				
			),
		),
		'creditcard_code' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Credit Card Code is required',
				
			),
			'rule2' => array(
				 'rule' => '/^[0-9]{3,4}$/i',
				 'message' => 'Credit Card Code is invalid',
				
			),
		),

        
    );
    
    public $hasMany = array(
        'OrderItem' => array(
            'className'=> 'OrderItem',
            'foreignKey'=> 'order_id',
            'dependent'=> true,
        )
    );
    
    
}
?>
