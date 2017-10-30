<?php

use yii\db\Migration;

class m170419_130147_add_purchase_work_contractno_column_to_service extends Migration
{
    public function up()
    {
        $this->addColumn('service', 'purchase_work_contractno', $this->text()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('service', 'purchase_work_contractno');
        // echo "m170419_130147_add_purchase_work_contractno_column_to_service cannot be reverted.\n";

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
