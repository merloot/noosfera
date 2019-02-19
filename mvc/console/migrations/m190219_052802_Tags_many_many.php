<?php

use yii\db\Migration;

/**
 * Class m190219_052802_Tags_many_many
 */
class m190219_052802_Tags_many_many extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('TagsConsultation','TagsConsultation','tc_con_id','Consultation','con_id','CASCADE');
        $this->addForeignKey('TagsConsultationTags','TagsConsultation','tc_tag_id','Tags','tag_id','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190219_052802_Tags_many_many cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_052802_Tags_many_many cannot be reverted.\n";

        return false;
    }
    */
}
