<?php
return [
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=partner1',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
    ]
];
