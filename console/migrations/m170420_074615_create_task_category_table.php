<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_category`.
 */
class m170420_074615_create_task_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->unique(),
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
        $this->dropTable('task_category');
    }
}
