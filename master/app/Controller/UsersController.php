<?php
App::uses('AppController', 'Controller');
/**
 * Userss Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $layout = 'user';

    public
        $uses = Array('User'),
        $components = array(
        'Session',
        'Auth' => Array(
            'loginRedirect' => Array(
                'controller'  => 'pages',
                'action' => 'home'
            ),
            'logoutRedirect' => Array(
                'controller' => 'users',
                'action' => 'login'),
            'loginAction' => Array(
                'controller' => 'users',
                'action' => 'login'),
            'authenticate' => Array(
                'Form' => Array(
                    'userModel' => 'User',
                    'fields' => Array(
                        'username' => 'username',
                        'password' => 'password',
                    )
                )
            )
        ),
        'Cookie'
    );
 
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login');
    }
  
    public function login() {
        $this->layout = 'login';
        if($this->request->is('post')) {
            // Cookie login
            if($this->Auth->login()) {
                $this->Cookie->write('Auth.User.id', $this->request->data['User']['id'], false, '+4 weeks');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
            }
        }
    }
/**
 * view method
 *
 * @param string $id
 * @return void
 */
    public function view($id = null) {
            $this->User->id = $id;
            if (!$this->User->exists()) {
                    throw new NotFoundException(__('Invalid %s', __('user')));
            }
            $this->set('user', $this->User->read(null, $id));
    }
 
    public function logout($id = null){
        $this->Cookie->delete('Auth.User.id'); //delete cookie
        $this->Session->destroy();
        $this->Session->delete('Auth.User');
        $this->redirect($this->Auth->logout('/users/login'));
    }
 
    public function add() {
        if($this->request->is('post')) {
            $this->User->create();

            //パスワードとパスチェックの値をハッシュ値変換
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

            /* パスワードがないときはセットしない */
            if (empty($this->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }else{
                $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            }
 
            // userのidとusernameを定義しないと暗号化されない hashing need both username and password
            $this->data['User'] += array(
                'id' => $id,
                'username' => $this->request->data['User']['username'],
            );
             
            if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
        $select_status = array('0' => 'On','1'=>'Off');
        $this->set(compact('select_status'));
	}    
}
