<?php
App::uses('AppController', 'Controller');
/**
 * Community Controller
 *
 * @property Community $Community
 * @property PaginatorComponent $Paginator
 */
class CommunityController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Session',);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Community->recursive = 1;
        $this->layout = 'admin';

        $this->paginate = array(
            'Community'=>array(
                'page'=>'1',
                'limit'=>'100',
                'order'=>'Community.created desc'
            )
        );
        $data_community = $this->paginate('Community');
		$this->set('communities', $data_community);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Community->exists($id)) {
			throw new NotFoundException(__('Invalid community'));
		}
        $this->layout = 'admin';
		$options = array('conditions' => array('Community.' . $this->Community->primaryKey => $id));
		$this->set('community', $this->Community->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->Community->recursive = 1;
        $this->layout = 'admin';

        $select_status = array('0' => '表示中','1'=>'非表示');
        $this->set(compact('select_status'));

		if ($this->request->is('post')) {
			$this->Community->create();
            try {
                $this->Community->createWithAttachments($this->request->data);
                $this->Session->setFlash(__('The community has been saved'));
            } catch (Exception $e) {
                $this->Session->setFlash($e->getMessage());
            }
        }
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->layout = 'admin';
		if (!$this->Community->exists($id)) {
			throw new NotFoundException(__('Invalid community'));
		}
		if ($this->request->is(array('post', 'put'))) {

            /*****************************************
             *  画像フィールド未入力時
             *****************************************/
            if(empty($this->request->data['Attachment']['0']['photo_community']['size'])){

                /*　画像データの取得 */
                $options_file = array(
                    'conditions' => array(
                        'Attachment.foreign_key' => $id,
                        'Attachment.del_flg' => 0,
                    )  ,
                    'order' => array('Attachment.id DESC'),
                    'limit' => 1
                );
                $files = $this->Community->Attachment->find('all',$options_file);

                if(!empty($files)){
                    $this->request->data['Attachment']['0'] = $files['0']['Attachment'];
                }

                if ($this->Community->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The community has been saved.'));
    				return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The community could not be saved. Please, try again.'));
                }

            /*****************************************
             *  画像あり
             *****************************************/
            }else{
                //既存画像データの処理
                $data = array(
                    'Attachment.del_flg' => '1',
                );
                $conditions = array(
                    'Attachment.del_flg' => '0',
                    'Attachment.foreign_key' => $id,
                );
                $this->Community->Attachment->updateAll($data, $conditions);
                if ($this->Community->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The community has been saved.'));
//				return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The community could not be saved. Please, try again.'));
                }
            }

		} else {
			$options = array('conditions' => array('Community.' . $this->Community->primaryKey => $id));
			$this->request->data = $this->Community->find('first', $options);
		}
        /*　画像データの取得 */
        $options_file = array(
            'conditions' => array(
                'Attachment.foreign_key' => $id,
                'Attachment.del_flg' => 0,
            )  ,
            'order' => array('Attachment.id DESC'),
            'limit' => 1
        );
        $files = $this->Community->Attachment->find('all',$options_file);
        $select_status = array('0' => 'Active','1'=>'Off');

        $this->set(compact('files','select_status'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        $this->layout = 'admin';
		$this->Community->id = $id;
		if (!$this->Community->exists()) {
			throw new NotFoundException(__('Invalid community'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Community->delete()) {
			$this->Session->setFlash(__('The community has been deleted.'));
		} else {
			$this->Session->setFlash(__('The community could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
