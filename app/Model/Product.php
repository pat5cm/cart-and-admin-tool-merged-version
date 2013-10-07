<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xin
 * Date: 06/09/2013
 * Time: 23:54
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppModel','Model');

class Product extends AppModel{
    
    public $validate = array(
        'name' => array(
            'rule1'=> array(
                'rule'=> array('notempty'),
                'message'=>'Name is invalid',
                'on'=>'create'
            ),
            'rule2'=> array(
                'rule'=>array('isUnique'),
                'message'=>'Name is not unique'
            )
        ),
        'slug' => array(
            'rule1'=> array(
                'rule'=>array('notempty'),
               'message'=>'Name is invalid'
                ),
            'rule2'=> array(
                'rule'=>array('isUnique'),
                'message'=>'Slug is not unique'
            )
        ),
        'price'=>array(
            'notempty'=> array(
                'rule'=>array('decimal'),
                'message'=>'Price must be decimal'
            )
            
        ),
        'weight' => array(
            'notempty'=> array(
                'rule'=> array('decimal'),
                'message' => 'Weight must be decimal'
            )
        ),
    );
    
    
    
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id'
        ),
        'Brand' => array(
            'className'=>'Brand',
            'foreignKey'=>'brand_id'
        )
    );

    public function updateViews($products) {

		if(!isset($products[0])) {
			$a = $products;
			unset($products);
			$products[0] = $a;
		}

		$this->unbindModel(
			array('belongsTo' => array('Category', 'Brand'))
		);

		$productIds = Set::extract('/Product/id', $products);

		$this->updateAll(
			array(
				'Product.views' => 'Product.views + 1',
			),
			array('Product.id' => $productIds)
		);


	}
}