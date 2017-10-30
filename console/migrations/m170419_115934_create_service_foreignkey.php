<?php

use yii\db\Migration;

class m170419_115934_create_service_foreignkey extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-service-customer_id',
            'service',
            'customer_id',
            'customer',
            'id',
            'CASCADE',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk-service-equipments_id',
            'service',
            'equipments_id',
            'equipments',
            'id',
            'CASCADE',
            'CASCADE'
            );
    }

    public function down()
    {
        $this->dropForeignKey('fk-service-customer_id', 'service');
        $this->dropForeignKey('fk-service-equipments_id', 'service');
        // echo "m170419_115934_create_service_foreignkey cannot be reverted.\n";

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
