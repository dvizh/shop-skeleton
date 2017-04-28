<?php

return [
    'name' => 'Название магазина',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru-RU',
    'bootstrap' => [
        'dektrium\user\Bootstrap',
        'dektrium\rbac\Bootstrap',
    ],

    'extensions' => yii\helpers\ArrayHelper::merge(
        require( dirname(dirname(__DIR__)) . '/vendor/yiisoft/extensions.php'),
        [
            'dektrium/yii2-rbac' => [
              'name' => 'dektrium/yii2-rbac',
              'version' => '1.0.0.0-alpha',
              'alias' => [
                '@dektrium/rbac' => '@dektrium/rbac',
              ],
            ],
        ]
    ),
    'components' => [
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'assetManager' => [
            'forceCopy' => false,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages', //
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            // 'clients' => [
            //     'google' => [
            //         'class' => 'yii\authclient\clients\Google',
            //         'clientId' => 'google_client_id',
            //         'clientSecret' => 'google_client_secret',
            //     ],
            //     'facebook' => [
            //         'class' => 'yii\authclient\clients\Facebook',
            //         'clientId' => 'facebook_client_id',
            //         'clientSecret' => 'facebook_client_secret',
            //     ],
            // ],
        ],
        'cart' => [
            'class' => 'dvizh\cart\Cart',
            'currency' => 'р.', //Валюта
            'currencyPosition' => 'after', //after или before (позиция значка валюты относительно цены)
            'priceFormat' => [2,'.', ''], //Форма цены
            'as set_discount' => ['class' => 'common\aspects\SetDiscount'],
            'as set_certificate_discount' => '\common\aspects\SetCertificateDiscount'
        ],
        'client' => [
            'class' => 'dvizh\client\Client',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => 'administrator',
        ],
        'gallery' => [
            'class' => 'dvizh\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)).'/frontend/web/images/store', //path to origin images
            'imagesCachePath' => dirname(dirname(__DIR__)).'/frontend/web/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => '@webroot/images/placeHolder.png',
        ],
        'order' => [
            'class' => 'dvizh\order\Module',
            'successUrl' => '/site/thanks', //Страница, куда попадает пользователь после успешного заказа
            //'adminNotificationEmail' => 'test@yandex.ru', //Мыло для отправки заказов
            'as use_certificate' => '\common\aspects\UseCertificate',
            'as order_filling' => '\common\aspects\OrderFilling',
        ],
        'cart' => [
            'class' => 'dvizh\cart\Module',
        ],
        'promocode' => [
            'class' => 'dvizh\promocode\Module',
            'informer' => 'dvizh\cart\widgets\CartInformer', // namespace to custom cartInformer widget
            'informerSettings' => [], //settings for custom cartInformer widget
            'clientsModel' => 'dvizh\yii2-clients\models\Client',
            //Указываем модели, к которым будем привязывать промокод
            'targetModelList' => [
                'Категории' => [
                    'model' => 'dvizh\shop\models\Category',
                    'searchModel' => 'dvizh\shop\models\category\CategorySearch'
                ],
                'Продукты' => [
                    'model' => 'dvizh\shop\models\Product',
                    'searchModel' => 'dvizh\shop\models\product\ProductSearch'
                ],
            ],
        ],
        'certificate' => [
            'class' => '\dvizh\certificate\Module',
            'targetModelList' => [
                'Категории' => [
                    'model' => 'dvizh\shop\models\Category',
                    'searchModel' => 'dvizh\shop\models\category\CategorySearch'
                ],
                'Продукты' => [
                    'model' => 'dvizh\shop\models\Product',
                    'searchModel' => 'dvizh\shop\models\product\ProductSearch'
                ],
            ]
        ],
        'shop' => [
            'class' => 'dvizh\shop\Module',
            'adminRoles' => ['superadmin'],
        ],
        'filter' => [
            'class' => 'dvizh\filter\Module',
            'adminRoles' => ['superadmin'],
            'relationFieldName' => 'category_id',
            'relationFieldValues' =>
                function() {
                    return \dvizh\shop\models\Category::buildTextTree();
                },
        ],
        'field' => [
            'class' => 'dvizh\field\Module',
            'relationModels' => [
                'dvizh\shop\models\Product' => 'Продукты',
                'dvizh\shop\models\Category' => 'Категории',
                'dvizh\shop\models\Producer' => 'Производители',
            ],
            'adminRoles' => ['superadmin'],
        ],
        'relations' => [
            'class' => 'dvizh\relations\Module',
            'fields' => ['code'],
        ],
        'client' => [
            'class' => 'dvizh\client\Module',
            'adminRoles' => ['superadmin'],
        ],
        'review' => [
            'class' => 'dvizh\review\Module',
        ],
    ],
];
