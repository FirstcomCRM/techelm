<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m170419_075246_create_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->unique(),
            'contact_person' => $this->string(150)->notNull(), 
            'job_site' => $this->text()->notNull(),
            'address' => $this->text()->notNull(),
            'email' => $this->string(50)->notNull(),
            'contact_number' => $this->string(50)->notNull(),
            'fax_number' => $this->string(50)->notNull(),
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
        $this->dropTable('customer');
    }
}
