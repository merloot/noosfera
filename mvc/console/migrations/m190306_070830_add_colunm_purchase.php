<?php

use yii\db\Migration;

/**
 * Class m190306_070830_add_colunm_purchase
 */
class m190306_070830_add_colunm_purchase extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('PurchaseConsultation','pc_type',$this->smallInteger()->defaultValue(1));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('PurchaseConsultation','pc_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_070830_add_colunm_purchase cannot be reverted.\n";

        return false;
    }
    */
}
