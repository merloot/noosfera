<?php

use yii\db\Migration;

/**
 * Class m190218_075318_add_column
 */
class m190218_075318_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        echo "m190218_075318_add_column cannot be reverted.\n";

    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

        $this->addColumn('SellingConsultation','sc_com_id',$this->bigInteger());
        $this->addColumn('PurchaseConsultation' ,'pc_com_id',$this->bigInteger());

        $this->addForeignKey('SellingConsultationCompetenceProfile','SellingConsultation','sc_com_id','Competence','com_id','CASCADE');
        $this->addForeignKey('PurchaseConsultationCompetenceProfile','PurchaseConsultation','pc_com_id','Competence','com_id','CASCADE');


    }

    public function down()
    {
        echo "m190218_075318_add_column cannot be reverted.\n";

        return false;
    }

}
