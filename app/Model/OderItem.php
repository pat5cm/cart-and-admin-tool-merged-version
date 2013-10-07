<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class OrderItem extends AppModel {
  
    public $validate = array(
            'order_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),

			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				
			),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				
			),
		),
    );
    
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'CounterCache' => true,
            'CounterScope' => array(),
        )
    );
    
}
?>
