<?php

use yii\db\Migration;

class m170419_100725_create_equipments_category_foreignkey extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-equipments-equipments_category_id',
            'equipments',
            'equipments_category_id',
            'equipments_category',
            'id',
            'CASCADE',
            'CASCADE'
            );
    }

    public function down()
    {
        $this->dropForeignKey('fk-equipments-equipments_category_id', 'equipments');
        // echo "m170419_100725_create_equipments_category_foreignkey cannot be reverted.\n";

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
