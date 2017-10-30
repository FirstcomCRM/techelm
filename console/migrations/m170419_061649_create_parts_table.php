<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parts`.
 */
class m170419_061649_create_parts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parts', [
            'id' => $this->primaryKey(),
            'parts_category_id' => $this->integer(5)->notNull(),
            'parts_code' => $this->string(150)->notNull(),
            'parts_name' => $this->string(150)->notNull()->unique(),
            'description' => $this->text()->notNull(),
            'quantity' => $this->integer(10)->notNull(),
            'unit_of_measure' => $this->string(100)->notNull(),
            'price' => $this->double(10,2)->notNull(),
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
        $this->dropTable('parts');
    }
}
