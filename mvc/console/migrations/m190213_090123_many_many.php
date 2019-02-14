<?php

use yii\db\Migration;

/**
 * Class m190213_090123_many_many
 */
class m190213_090123_many_many extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropPrimaryKey('CompetenceProfile_pkey', 'CompetenceProfile');
        $this->addPrimaryKey('CompetenceProfile_pkey', 'CompetenceProfile', [
            'cp_com_id',
            'cp_p_id'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190213_090123_many_many cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190213_090123_many_many cannot be reverted.\n";

        return false;
    }
    */
}
