<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_group`.
 */
class m170418_102121_create_user_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique(),
            'status' => $this->integer(5)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer(5)->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer(5)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user-user_group_id',
            'user',
            'user_group_id',
            'user_group',
            'id',
            'CASCADE',
            'CASCADE'
            );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_group');

        $this->dropForeignKey('fk-user-user_group_id', 'user');
    }
}
