<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity.
 */
class CeoInfo extends Entity
{
    public $imageFields = [
        'image' => [
            'size' => 3145728, //3*1024*1024 B
            'extensions' => ['Jpg', 'Png'],
            'required' => FALSE
        ],
    ];

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'type' => true,
        'position_eng' => true,
        'position_jpn' => true,
        'position_vie' => true,
        'comment_eng' => true,
        'comment_jpn' => true,
        'comment_vie' => true,
        'image' => true,
        'image_tmp' => true,
        'active' => true,
        '*' => true
    ];
}
