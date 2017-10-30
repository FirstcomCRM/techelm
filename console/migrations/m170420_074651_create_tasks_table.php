<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m170420_074651_create_tasks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'task_category_id' => $this->integer(5)->notNull(),
            'tasks_code' => $this->string(150)->notNull(),
            'tasks_name' => $this->string(150)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'status' => $this->integer(5)->notNull(),
            'created_at' => $this->datetime()->notNull(),
            'created_by' => $this->integer(5)->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'updated_by' => $this->integer(5)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tasks');
    }
}
