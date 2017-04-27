<?php
class m170426_174712_insert_user_role extends \yii\db\Migration
{
    public function up()
    {
        $this->insert('{{%rbac_auth_item}}', [
            'name' => 'superadmin',
            'type' => '1',
            'description' => '',
            'rule_name' => NULL,
            'data' => 1492519500,
            'created_at' => 1492519500,
            'updated_at' => 1492519500,
        ]);

        $this->insert('{{%rbac_auth_assignment}}', [
            'item_name' => 'superadmin',
            'user_id' => '1',
            'created_at' => 1492519516,
        ]);
    }

    public function down()
    {

    }
}