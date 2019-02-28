<?php

use yii\db\Migration;

/**
 * Class m190228_073324_key_consultation
 */
class m190228_073324_key_consultation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addForeignKey('ConsultationSelling','Consultation','con_sc_id','SellingConsultation','sc_id','CASCADE');
        $this->addForeignKey('ConsultationPurchase','Consultation','con_pc_id','PurchaseConsultation','pc_id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190228_073324_key_consultation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190228_073324_key_consultation cannot be reverted.\n";

        return false;
    }
    */
}
