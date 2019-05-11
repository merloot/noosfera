<?php

use yii\db\Migration;

/**
 * Class m190413_052752_tags_key
 */
class m190413_052752_tags_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('TagsSelling','TagsConsultation','tc_sc_id','SellingConsultation','sc_id');
        $this->addForeignKey('TagsPurchase','TagsConsultation','tc_pc_id','PurchaseConsultation','pc_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
     $this->dropForeignKey('TagsSelling','TagsConsultation');
     $this->dropForeignKey('TagsPurchase','TagsConsultation');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190413_052752_tags_key cannot be reverted.\n";

        return false;
    }
    */
}
