<?php

use yii\db\Migration;

/**
 * Class m240329_153359_create_file
 */
class m240329_153359_create_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(
            'files',
            [
                'id'               => $this->primaryKey(),
                'file_name'        => $this->string(128)->notNull(),
                'created_at'       => $this->datetime()->null(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240329_153359_create_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240329_153359_create_file cannot be reverted.\n";

        return false;
    }
    */
}
