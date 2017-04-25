<?php
use yii\db\Schema;
use yii\db\Migration;

class m170425_150102_base_migration extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%news}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(255) NOT NULL',
                'slug' => Schema::TYPE_STRING . '(255)',
                'anons' => Schema::TYPE_STRING . '(300)',
                'text' => Schema::TYPE_TEXT . ' NULL',
                'status' => Schema::TYPE_STRING . '(55)',
                'date' => Schema::TYPE_TIME,
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%page}}',
            [
                'id' => Schema::TYPE_PK,
                'parent_id' => Schema::TYPE_INTEGER . '(11) NULL',
                'name' => Schema::TYPE_STRING . '(255) NOT NULL',
                'slug' => Schema::TYPE_STRING . '(255)',
                'template' => Schema::TYPE_STRING . '(55) NOT NULL',
                'text' => Schema::TYPE_TEXT . ' NULL',
                'status' => Schema::TYPE_STRING . '(55) NOT NULL DEFAULT \'draft\'',
                'show_page' => Schema::TYPE_STRING . '(10) NOT NULL DEFAULT \'no\'',
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%slider}}',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(255)',
                'url' => Schema::TYPE_STRING . '(255)',
                'slug' => Schema::TYPE_STRING . '(255)',
                'short_text' => Schema::TYPE_TEXT . ' NULL',
                'sort' => Schema::TYPE_INTEGER . '(11) NULL',
            ],
            $tableOptions
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
        $this->dropTable('{{%page}}');
        $this->dropTable('{{%slider}}');
    }
}