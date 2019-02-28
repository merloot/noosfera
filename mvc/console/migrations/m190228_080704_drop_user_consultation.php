<?php

use yii\db\Migration;

/**
 * Class m190228_080704_drop_user_consultation
 */
class m190228_080704_drop_user_consultation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('Consultation','con_sc_user_id');
        $this->dropColumn('Consultation','con_pc_user_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190228_080704_drop_user_consultation cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190228_080704_drop_user_consultation cannot be reverted.\n";

        return false;
    }
    */
}
