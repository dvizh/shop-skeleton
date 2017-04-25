<?php

namespace common\models;

use Yii;

class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'anons', 'text'], 'required'],
            [['text', 'status'], 'string'],
            [['date'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 55],
            [['anons'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Заголовок',
            'anons' => 'Анонс',
            'text' => 'Текст',
            'slug' => 'Seo-заголовок',
            'date' => 'Дата',
            'status' => 'Статус',
        ];
    }
}
