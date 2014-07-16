<?php
App::uses('AppModel', 'Model');
/**
 * Make Model
 *
 * @property Stock $Stock
 */
class Attachment extends AppModel{

    public $actsAs = array(
        'Upload.Upload' => array(
            'photo_information' => array(
//                'thumbnailSizes' => array(
//                    'thumb150' => '150x150',
//                    'thumb80' => '80x80',
//                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
                'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
                'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
                'maxSize' => 2097152, //2MB
            ),
            'photo_community' => array(
//                'thumbnailSizes' => array(
//                    'thumb150' => '150x150',
//                    'thumb80' => '80x80',
//                ),
                'thumbnailMethod' => 'php',
                'fields' => array('dir' => 'dir', 'type' => 'type', 'size' => 'size'),
                'mimetypes' => array('image/jpeg', 'image/gif', 'image/png'),
                'extensions' => array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'png', 'PNG'),
                'maxSize' => 2097152, //2MB
            )
        )
    );
    public $belongsTo = array(
        'Information' => array(
            'className' => 'Information',
            'foreignKey' => 'foreign_key',
        ),
        'Community' => array(
            'className' => 'Community',
            'foreignKey' => 'foreign_key',
        )
    );
}
