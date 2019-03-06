<?php

use yii\db\Migration;

/**
 * Class m190306_034827_add_column_type
 */
class m190306_034827_add_column_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('SellingConsultation','sc_type',$this->smallInteger()->defaultValue(1));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_034827_add_column_type cannot be reverted.\n";

        return false;
    }
    */
}
