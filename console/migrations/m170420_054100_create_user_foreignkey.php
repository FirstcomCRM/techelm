<?php

use yii\db\Migration;

class m170420_054100_create_user_foreignkey extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-user-department_id',
            'user',
            'department_id',
            'departments',
            'id',
            'CASCADE',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk-user-designated_position_id',
            'user',
            'designated_position_id',
            'designated_position',
            'id',
            'CASCADE',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk-user-race_id',
            'user',
            'race_id',
            'race',
            'id',
            'CASCADE',
            'CASCADE'
            );
    }

    public function down()
    {
        $this->dropForeignKey('fk-user-department_id', 'user');
        $this->dropForeignKey('fk-user-designated_position_id', 'user');
        $this->dropForeignKey('fk-user-race_id', 'user');
        // echo "m170420_054100_create_user_foreignkey cannot be reverted.\n";

        // return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
