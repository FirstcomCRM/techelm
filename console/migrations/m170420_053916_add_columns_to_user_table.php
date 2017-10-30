<?php

use yii\db\Migration;

class m170420_053916_add_columns_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'department_id', $this->integer(10)->notNull());
        $this->addColumn('user', 'designated_position_id', $this->integer(10)->notNull());
    }   

    public function down()
    {
        $this->dropColumn('user', 'department_id');
        $this->dropColumn('user', 'designated_position_id');
        // echo "m170420_053916_add_columns_to_user_table cannot be reverted.\n";

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
