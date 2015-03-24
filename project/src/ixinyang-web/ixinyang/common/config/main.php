<?php
    require(__DIR__ . '/autoload.php');


return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'prefix' => function ($message) {
                        $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                        $userID = $user ? $user->getId(false) : '-';
                        return "[$userID]";
                     },
                    'levels' => ['trace', 'info', 'error'],
                    'categories' => ['yii\*'],
                ],
            ],
        ],
    ],
    'timeZone' => 'Asia/Chongqing',
];
