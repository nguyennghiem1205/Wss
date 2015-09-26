<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Admin' => $baseDir . '/plugins/Admin/',
        'Api' => $baseDir . '/plugins/Api/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Page' => $baseDir . '/plugins/Page/',
        'Setting' => $baseDir . '/plugins/Setting/',
        'Social' => $baseDir . '/plugins/Social/',
        'System' => $baseDir . '/plugins/System/'
    ]
];
