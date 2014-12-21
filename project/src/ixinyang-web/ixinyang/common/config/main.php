<?php
    require(__DIR__ . '/autoload.php');


return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'log' => [
                'targets' => [
                    'file' => [
                        'class' => 'yii\log\FileTarget',
                        'levels' => [ 'error'],
                        'categories' => ['yii\*'],
                    ],
                ],
            ],
        ],
    ],
];
