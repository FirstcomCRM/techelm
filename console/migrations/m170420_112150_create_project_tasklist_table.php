<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project_tasklist`.
 */
class m170420_112150_create_project_tasklist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('project_tasklist', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer(10)->notNull(),
            'task_id' => $this->string(100)->notNull(),
            'project_condition' => $this->string(50)->notNull(),
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
        $this->dropTable('project_tasklist');
    }
}
