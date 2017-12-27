<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use vova07\imperavi\actions\GetAction;

use dvizh\order\models\tools\OrderSearch;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['superadmin', 'admin', 'administrator'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => 'http://shop.local/images/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/vova07', // Or absolute path to directory where files are stored.
                'options' => ['only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']], // These options are by default.
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => 'http://shop.local/images/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/vova07', // Or absolute path to directory where files are stored.
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOrderHistory()
    {
        $searchModel = new OrderSearch();

        $searchParams = yii::$app->request->queryParams;
        $searchParams['OrderSearch']['is_deleted'] = 0;



        $dataProvider = $searchModel->search($searchParams);

        $dataProvider = $searchModel->search($searchParams);

        if(!yii::$app->request->get('sort')) {
            $dataProvider->query->orderBy('id DESC');
        }

        if(yii::$app->request->get('time_start')) {
            $dataProvider->query->orderBy('order.timestamp ASC');
            $dataProvider->pagination = ["pageSize" => 100];
        }


        return $this->render('orderHistory', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

    }


}
