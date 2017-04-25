<?php

use yii\db\Schema;
use yii\db\Migration;

class m170317_090234_page extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%page}}',
            [
                'id'=> $this->primaryKey(11),
                'show_page'=> $this->string()->notNull()->defaultValue('No'),
                'slug'=> $this->string(255)->notNull(),
                'title'=> $this->string(255)->notNull(),
                'text'=> $this->text()->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
