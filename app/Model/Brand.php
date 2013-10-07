<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xin
 * Date: 24/09/2013
 * Time: 16:44
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppModel','Model');

class Brand extends AppModel {
    
    // Validation for Table Brand
    public $validate = array(
             'name'  => array(
                 'rule1'=> array(
                        'rule'=>'notempty',
                        'message'=>'Please enter a valid name',
                        'on' => 'create',
                 ),
                 'rule2'=> array(
                        'rule'=>'isUnique',
                        'message'=>'Name is not unique',
               
                 )
             ),
             'slug' => array(
                 'rule1'=> array(
                     'rule'=>'notempty',
                     'message'=>'Please enter a valide slug',
                     'on'=>'create',
                 ),
                 'rule2'=>array(
                     'rule'=>'isUnique',
                     'message'=>'Slug is not unique',
                     
                 )
             )
    ); 
    
    //Define relationship with Product table
    public $hasMany = array(
        'Product'=> array(
            'className'=>'Product',
            'foreignkey'=>'brand_id',
            'dependent'=>false
        )
    );
    
    public function findlist(){
        return $this->find('list',array(
                'order'=>array(
                    'Brand.name'=>'ASC'
                )
        ));
    }

}


?>