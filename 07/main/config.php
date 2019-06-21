<?php
return [
    'name' => 'Магазин',
    'defaultAction' => 'users',

    'components' => [
        'db' => [
            'class' => \App\services\Db::class,
            'config' => [
                'driver' => 'mysql',
                'db' => 'gbphp',
                'host' => 'localhost',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8'
            ]
        ],
        'render' => [
            'class' => \App\services\renders\TmplRender::class
        ],
        'userRepository' => [
            'class' => \App\models\repositories\UserRepository::class
        ],
        'goodRepository' => [
            'class' => \App\models\repositories\GoodRepository::class
        ],
    ],
];