<?php

namespace app\controllers;

use app\components\Card;
use app\models\Items;
use app\widgets\CardWidget;
use Yii;
use app\models\CardForm;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'card' => ['post'],
                    'delete' => ['post'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new CardForm();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCard()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new CardForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'result' => CardWidget::widget(),
            ];
        } else {
            return [
                'success' => false,
                'errors' => $model->getErrors(),
            ];
        }
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        Card::deleteCardItem($id);
        return [
            'success' => true,
            'result' => CardWidget::widget(),
        ];
    }

    public function actionList($q)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = ArrayHelper::map(Items::itemList($q), 'id', function ($data) {
            /**
             * @var $data Items
             */
            return [
                'id' => $data->id,
                'title' => $data->title,
            ];
        });
        return [
            'results' => array_values($result),
        ];
    }
}
