<?php

use yii\db\Migration;

/**
 * Handles adding again to table `user`.
 */
class m170418_103443_add_again_columns_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'created_by', $this->integer(10)->notNull());
        $this->addColumn('user', 'updated_by', $this->integer(10)->notNull());
        $this->addColumn('user', 'deleted', $this->integer(5)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'created_by');
        $this->dropColumn('user', 'updated_by');
        $this->dropColumn('user', 'deleted');
    }
}
