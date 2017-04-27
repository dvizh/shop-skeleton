<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'Админка',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'as backend' => 'dektrium\user\filters\BackendFilter',
            'admins' => [
                'administrator'
            ],
            'enableUnconfirmedLogin' => true,
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
    'components' => [
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/frontend/web/images/source',
            'filesystem'=> function() {
                $adapter = new \League\Flysystem\Adapter\Local(dirname(dirname(__DIR__)).'/frontend/web/images/source');
                return new League\Flysystem\Filesystem($adapter);
            },
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'request' => [
            'baseUrl' => '/backend/web',
            'csrfParam' => '_csrf-backend',
        ],
        'session' => [
            'name' => 'backend-sess',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/backend/web',
            ],
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/backend/web',
                'httpOnly' => true,
            ],
            'loginUrl' => ['/user/security/login'],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
