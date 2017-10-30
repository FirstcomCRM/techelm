<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_workerlist`.
 */
class m170419_115333_create_service_workerlist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('service_workerlist', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(10)->notNull(),
            'user_id' => $this->string(100)->notNull(),
            'service_condition' => $this->string(50)->notNull(),
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
        $this->dropTable('service_workerlist');
    }
}
