<?php

use yii\db\Migration;

/**
 * Handles the creation of table `departments`.
 */
class m170420_035830_create_departments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('departments', [
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
        $this->dropTable('departments');
    }
}
