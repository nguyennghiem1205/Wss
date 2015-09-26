<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity.
 */
class Category extends Entity
{
    public $imageFields = [
        'image' => [
            'size' => 3145728, //3*1024*1024 B
            'extensions' => ['Jpg', 'Png'],
            'required' => false
        ],
    ];
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title_eng' => true,
        'title_jpn' => true,
        'title_vie' => true,
        'description_eng' => true,
        'description_jpn' => true,
        'description_vie' => true,
        'content_eng' => true,
        'content_jpn' => true,
        'content_vie' => true,
        'image' => true,
        'image_tmp' => true,
        'active' => true,
        'parent_id' => true,
        '*' => true,
    ];
}
