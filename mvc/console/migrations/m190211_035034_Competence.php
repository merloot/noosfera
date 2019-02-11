<?php

use yii\db\Migration;

/**
 * Class m190211_035034_Competence
 */
class m190211_035034_Competence extends Migration
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
        echo "m190211_035034_Competence cannot be reverted.\n";

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

        $this->createTable('{{%Competence}}', [
            'com_id' => $this->primaryKey(),
            'competence' => $this->string(100)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%CompetenceProfile}}',[
            'cp_id'=>$this->primaryKey(),
            'cp_p_id'=>$this->integer(11)->notNull(),
            $this->addForeignKey("competence_profile","{{%CompetenceProfile}}",'cp_id',"{{%Competence}}","com_id"),
            $this->addForeignKey("competence_profile_user","{{%Profile}}","p_user_id","{{%CompetenceProfile}}","cp_p_id")

        ],$tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%Competence}}');
        $this->dropTable('{{%CompetenceProfile}}');
        $this->dropForeignKey("competence_profile","{{%CompetenceProfile}}");
        $this->dropForeignKey("competence_profile_user","{{%CompetenceProfile}}");

    }

}
