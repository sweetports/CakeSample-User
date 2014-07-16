<?php
App::uses('AppModel', 'Model');
/**
 * Information Model
 *
 */
class Information extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'informations';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    public $hasMany = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_key',
            'conditions' => array(
                'Attachment.model' => 'Information',
            ),
        ),
    );

    public function createWithAttachments($data) {
        // Sanitize your images before adding them
        $images = array();
        if (!empty($data['Attachment'][0])) {
            foreach ($data['Attachment'] as $i => $image) {
                if (is_array($data['Attachment'][$i])) {
                    // Force setting the `model` field to this model
                    $image['model'] = 'Information';

                    // Unset the foreign_key if the user tries to specify it
                    if (isset($image['foreign_key'])) {
                        unset($image['foreign_key']);
                    }

                    $images[] = $image;
                }
            }
        }
        $data['Attachment'] = $images;

        // Try to save the data using Model::saveAll()
        $this->create();
        if ($this->saveAll($data)) {
            return true;
        }else{
            // Throw an exception for the controller
            throw new Exception(__("This information could not be saved. Please try again"));
        }
    }
}
