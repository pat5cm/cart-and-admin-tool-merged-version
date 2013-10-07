<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
    
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('register'); // Letting users register themselves
	}
    
//    	public function register() 
//	{
//        if ($this->request->is('post')) {
//			if ($this->checkExitedUser($this->request->data['User']['username']) == true)
//			{
//				$this->User->create();
//				if ($this->User->save($this->request->data)) {
//					$this->Session->setFlash(__('Your have been successfully registered <a href="login">Login</a>.'));
//					return $this->redirect(array('action' => 'register'));
//				}
//				$this->Session->setFlash(__('Unable to register you.'));
//			}
//			else
//			{
//				$this->Session->setFlash(__('Duplicated Username'));
//			}
//            }
//        }
       public function register() {
            if ($this->request->is('post')) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Your have been successfully registered'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
	
//	public function checkExitedUser($email = null) {
//        if ($email) {
//			$found = $this->User->findByEmail($email);
//			if (!$found) {
//				//print $email;
//				return true;
//			}
//		}
//        return false;
//    }
	

        public function login() 
            {
                    if ($this->request->is('post')) 
                    {
                            if ($this->Auth->login($this->data)) 
                            {
                                    $this->Session->write('UserEmail', $this->request->data['User']['email']);
                                    return $this->redirect($this->Auth->redirect());
                            }
                            $this->Session->setFlash(__('Invalid username or password, try again'));
                    }
            }

        public function logout() 
	{
		return $this->redirect($this->Auth->logout());
	}
	
	public function index() 
	{
            
        }
	
	public function profile()
	{
		$customer = $this->User->findByEmail($this->Session->read('CustomerEmail'));
		$id = $customer['Customer']['id'];
		if (!$customer) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your details has been updated.'));
				return $this->redirect(array('action' => '/index'));
			}
			$this->Session->setFlash(__('Unable to update your post.'));
		}
		
		if (!$this->request->data) 
		{
			$this->request->data = $User;
		}
	}
        
  
}