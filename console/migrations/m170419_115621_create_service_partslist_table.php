<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_partslist`.
 */
class m170419_115621_create_service_partslist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('service_partslist', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(10)->notNull(),
            'parts_id' => $this->string(100)->notNull(),
            'price' => $this->double(10,2)->notNull(),
            'quantity' => $this->integer(50)->notNull(),
            'unit_price' => $this->double(10,2)->notNull(),
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
        $this->dropTable('service_partslist');
    }
}
