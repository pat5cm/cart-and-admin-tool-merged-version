<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController{
    
    public $components = array(
		'RequestHandler',
//                'Pagination',
	);
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    
    public function index(){
        $products = $this->Product->find('all', array(
            'recursive'=>-1,
            'contain'=> 'Brand',
            'limit' => 8,
            'conitions'=> array(
                'Product.active' => 1,
                'Brand.active' => 1
            ),
            'order' => 'Product.views DESC'
        ));
        $this->set(compact('products'));
        $this->Product->updateViews($products);
        $this->set('title_for_layout',configure::read('Settings.SHOP_TITLE'));
    }
    
////////////////////////////////////////////////////////////

	public function view($id = null) {

		$product = $this->Product->find('first', array(
			'recursive' => 0,
			'contain' => array(
				'Category',
				'Brand'
			),
			'conditions' => array(
				'Brand.active' => 1,
				'Product.active' => 1,
				'Product.slug' => $id
			)
		));
		if (empty($product)) {
			return $this->redirect(array('action' => 'index'), 301);
		}

		$this->Product->updateViews($product);

		$this->set(compact('product'));

		$this->set('title_for_layout', $product['Product']['name'] . ' ' . Configure::read('Settings.SHOP_TITLE'));

	}

////////////////////////////////////////////////////////////
        
        	public function products() {

		$this->Paginator = $this->Components->load('Paginator');

		$this->Paginator->settings = array(
			'Product' => array(
				'recursive' => 0,
				'contain' => array(
					'Brand'
				),
				'limit' => 12,
				'conditions' => array(
					'Product.active' => 1,
					'Brand.active' => 1
				),
				'order' => array(
					'Product.name' => 'ASC'
				),
				'paramType' => 'querystring',
			)
		);
		$products = $this->Paginator->paginate();
		$this->set(compact('products'));

		$this->set('title_for_layout', 'All Products - ' . Configure::read('Settings.SHOP_TITLE'));

	}

}
