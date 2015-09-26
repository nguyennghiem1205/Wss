<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;



class Recruit extends Entity
{
    public $imageFields = [
        'image' => [
            'size' => 3145728, //3*1024*1024 B
            'extensions' => ['Jpg', 'Png'],
            'required' => false
        ],
        'file' => [
            'size' => 3145728, //3*1024*1024 B
            'extensions' => ['Pdf', 'Xlsx', 'Xls'],
            'required' => false
        ],
    ];

    protected $_accessible = [
        '*' => true,
        'id' => false,
        'image_tmp' => true,
        'file_tmp' => true,
    ];
}
