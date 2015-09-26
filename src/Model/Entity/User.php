<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Utility\Security;

/**
 * User Entity.
 */
class User extends Entity
{
    public $imageFields = [
        'avatar' => [
            'size' => 3145728, //3*1024*1024 B
            'extensions' => ['Jpg', 'Png'],
            'required' => true
        ],
        'test_field_image' => [
            'size' => 100000,
            'extensions' => ['jpg', 'png'],
            'required' => false
        ]
    ];
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'old_password' => true,
        'new_password' => true,
        'avatar' => true,
        'avatar_tmp' => true,
        'hw_file_errors' => true,
    ];

    protected function _setPassword($password)
    {
        return Security::hash($password, 'sha1', true);
    }
}
