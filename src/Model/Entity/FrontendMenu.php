<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity.
 */
class FrontendMenu extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name_eng' => true,
        'name_jpn' => true,
        'name_vie' => true,
        'description_eng' => true,
        'description_jpn' => true,
        'description_vie' => true,
        'parent_id' => true,
        'link' => true,
        'active' => true,
    ];
}
