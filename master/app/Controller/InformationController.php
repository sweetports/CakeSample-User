<?php
App::uses('AppController', 'Controller');
/**
 * Information Controller
 *
 * @property Information $Information
 * @property PaginatorComponent $Paginator
 */
class InformationController extends AppController {

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
		$this->Information->recursive = 1;
        $this->layout = 'admin';

        $this->paginate = array(
            'Information'=>array(
                'page'=>'1',
                'limit'=>'100',
                'order'=>'Information.created desc'
            )
        );
        $data_information = $this->paginate('Information');
		$this->set('information', $data_information);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Information->exists($id)) {
			throw new NotFoundException(__('Invalid information'));
		}
        $this->layout = 'admin';
		$options = array('conditions' => array('Information.' . $this->Information->primaryKey => $id));
		$this->set('information', $this->Information->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->Information->recursive = 1;
        $this->layout = 'admin';

        $select_status = array('0' => '表示中','1'=>'非表示');
        $this->set(compact('select_status'));

		if ($this->request->is('post')) {
			$this->Information->create();
            try {
                $this->Information->createWithAttachments($this->request->data);
                $this->Session->setFlash(__('The information has been saved'));
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
		if (!$this->Information->exists($id)) {
			throw new NotFoundException(__('Invalid information'));
		}
		if ($this->request->is(array('post', 'put'))) {

            /*****************************************
             *  画像フィールド未入力時
             *****************************************/
            if(empty($this->request->data['Attachment']['0']['photo_information']['size'])){

                /*　画像データの取得 */
                $options_file = array(
                    'conditions' => array(
                        'Attachment.foreign_key' => $id,
                        'Attachment.del_flg' => 0,
                    )  ,
                    'order' => array('Attachment.id DESC'),
                    'limit' => 1
                );
                $files = $this->Information->Attachment->find('all',$options_file);

                if(!empty($files)){
                    $this->request->data['Attachment']['0'] = $files['0']['Attachment'];
                }

                if ($this->Information->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The information has been saved.'));
    				return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The information could not be saved. Please, try again.'));
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
                $this->Information->Attachment->updateAll($data, $conditions);
                if ($this->Information->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The information has been saved.'));
//				return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The information could not be saved. Please, try again.'));
                }
            }

		} else {
			$options = array('conditions' => array('Information.' . $this->Information->primaryKey => $id));
			$this->request->data = $this->Information->find('first', $options);
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
        $files = $this->Information->Attachment->find('all',$options_file);
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
		$this->Information->id = $id;
		if (!$this->Information->exists()) {
			throw new NotFoundException(__('Invalid information'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Information->delete()) {
			$this->Session->setFlash(__('The information has been deleted.'));
		} else {
			$this->Session->setFlash(__('The information could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
