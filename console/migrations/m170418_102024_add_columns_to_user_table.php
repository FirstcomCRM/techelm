<?php

use yii\db\Migration;

class m170418_102024_add_columns_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'user_group_id', $this->integer(10)->notNull());
        $this->addColumn('user', 'role', $this->integer(10)->notNull());
        $this->addColumn('user', 'fullname', $this->string(50)->notNull());
        $this->addColumn('user', 'password', $this->string(50)->notNull());
        $this->addColumn('user', 'contact_no', $this->string(15)->notNull());
        $this->addColumn('user', 'race_id', $this->integer(10)->notNull());
        $this->addColumn('user', 'photo', $this->string(50)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'user_group_id');
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'fullname');
        $this->dropColumn('user', 'password');
        $this->dropColumn('user', 'contact_no');
        $this->dropColumn('user', 'race_id');
        $this->dropColumn('user', 'photo');

        // echo "m170418_102024_add_columns_to_user_table cannot be reverted.\n";

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
