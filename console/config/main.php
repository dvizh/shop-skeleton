<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
        'rbac' => 'dektrium\rbac\RbacConsoleModule',
    ],
    'components' => [
        // 'authManager' => [
        //     'class' => 'yii\rbac\DbManager',
        //     'itemTable' => '{{%rbac_auth_item}}',
        //     'itemChildTable' => '{{%rbac_auth_item_child}}',
        //     'assignmentTable' => '{{%rbac_auth_assignment}}',
        //     'ruleTable' => '{{%rbac_auth_rule}}'
        // ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
