<?php

use yii\db\Migration;

/**
 * Class m190228_072455_update
 */
class m190228_072455_update extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('SellingConsultationCompetenceProfile','SellingConsultation');
        $this->dropForeignKey('PurchaseConsultationCompetenceProfile','PurchaseConsultation');
        $this->dropColumn('SellingConsultation','sc_con_id');
        $this->dropColumn('PurchaseConsultation','pc_con_id');
        $this->addColumn('Consultation','con_sc_id',$this->bigInteger());
        $this->addColumn('Consultation','con_pc_id',$this->bigInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190228_072455_update cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190228_072455_update cannot be reverted.\n";

        return false;
    }
    */
}
