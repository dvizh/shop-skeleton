<?php

namespace common\models;

use Yii;

class Page extends \yii\db\ActiveRecord
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
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'text'], 'required'],
            [['text','show_page', 'template'], 'string'],
            [['slug', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_page' => 'Показывать в главном меню',
            'slug' => 'SEO-имя',
            'name' => 'Заголовок',
            'text' => 'Текст',
        ];
    }
}
