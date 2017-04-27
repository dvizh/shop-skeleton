<?php
class m170418_170456_register_user extends \yii\db\Migration
{
    public function up()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'administrator',
            'email' => 'administrator@localhost.lc',
            'password_hash' => '$2y$10$C5nrtr7JOXXz0CZ/5aymjOu3Vx3iTOm9HcqpPs3D7ZiCXoVOFKAn.',
            'auth_key' => 'qI8YZpXSQF1dujgB0GH9361xDfcB8Qwl',
            'confirmed_at' => '1492070371',
            'unconfirmed_email' => null,
            'blocked_at' => null,
            'registration_ip' => '127.0.0.1',
            'created_at' => 1492070371,
            'updated_at' => 1492070371,
            'flags' => 0,
            'last_login_at' => null
        ]);

        $this->insert('{{%profile}}', [
            'user_id' => 1,
            'name' => null,
            'public_email' => null,
            'gravatar_email' => null,
            'gravatar_id' => null,
            'location' => null,
            'website' => null,
            'bio' => null,
            'timezone' => null
        ]);
    }

    public function down()
    {

    }
}