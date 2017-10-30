<?php

use yii\db\Migration;

class m170420_074958_create_tasks_foreignkey extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-tasks-task_category_id',
            'tasks',
            'task_category_id',
            'task_category',
            'id',
            'CASCADE',
            'CASCADE'
            );
    }

    public function down()
    {
        $this->dropForeignKey('fk-tasks-task_category_id', 'tasks');
        // echo "m170420_074958_create_tasks_foreignkey cannot be reverted.\n";

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
