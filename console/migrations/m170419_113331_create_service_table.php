<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170419_113331_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'service_code' => $this->string(100)->notNull(),
            'report_no' => $this->string(100)->notNull(),
            'date_call' => $this->date()->notNull(),
            'report_time' => $this->time()->notNull(),
            'contract_servicing' => $this->integer(5)->notNull(),
            'warranty_servicing' => $this->integer(5)->notNull(),
            'charges' => $this->integer(5)->notNull(),
            'contract_repair' => $this->integer(5)->notNull(),
            'warranty_repair' => $this->integer(5)->notNull(),
            'others' => $this->integer(5)->notNull(),
            'customer_id' => $this->integer(10)->notNull(),
            'equipments_id' => $this->integer(10)->notNull(),
            'model_serialno' => $this->string(100)->notNull(),
            'complaints' => $this->text()->notNull(),
            'action' => $this->text()->notNull(),
            'equipment_back_repairservice' => $this->integer(5)->notNull(),
            'estimate_cost_repair' => $this->integer(5)->notNull(),
            'transportation_charge' => $this->integer(5)->notNull(),
            'date_attended' => $this->datetime(),
            'date_completed' => $this->datetime(),
            'start_time' => $this->time(),
            'end_time' => $this->time(),
            'sub_total' => $this->double(10,2),
            'gst' => $this->double(10,2),
            'gst_value' => $this->double(10,2),
            'grand_total' => $this->double(10,2),
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
        $this->dropTable('service');
    }
}
