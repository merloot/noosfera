<?php

use yii\db\Migration;

/**
 * Class m190228_042622_add
 */
class m190228_042622_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('Consultation','con_title',$this->string(50));
        $this->addColumn('Consultation','con_description',$this->string(255));
        $this->addColumn('Consultation','con_com_id',$this->bigInteger());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('Consultation','con_title');
        $this->dropColumn('Consultation','con_description');
        $this->dropColumn('Consultation','con_com_id');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190228_042622_add cannot be reverted.\n";

        return false;
    }
    */
}
