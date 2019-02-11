<?php

use yii\db\Migration;

/**
 * Class m190211_040555_Tags
 */
class m190211_040555_Tags extends Migration
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
        echo "m190211_040555_Tags cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Tags}}', [
            'tag_id' => $this->primaryKey(),
            'tag_name' => $this->string(100)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%TagsConsultation}}',[
            'tc_id'=>$this->primaryKey(),
            'tc_tag_id'=>$this->integer(11)->notNull(),
            'tc_con_id'=>$this->integer('11')->notNull(),
            $this->addForeignKey("tags_consultation","{{%Tags}}",'tag_id',"{{%TagsConsultation}}","tc_tag_id"),
            $this->addForeignKey("tags_consultation_consultation",'{{%Tags}}',"tc_con_id","{{%Consultation}}","con_id")

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%Tags}}');
        $this->dropTable('{{%TagsConsultation}}');
        $this->dropForeignKey('tags_consultation',"{{%TagsConsultation}}");
        $this->dropForeignKey('tags_consultation_consultation',"{{%TagsConsultation}}");
    }

}
