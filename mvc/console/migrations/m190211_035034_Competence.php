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

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%CompetenceController}}', [
            'com_id' => $this->primaryKey(),
            'competence' => $this->string(100)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%CompetenceProfile}}',[
            'cp_id'=>$this->primaryKey(),
            'cp_com_id'=>$this->bigInteger()->notNull(),
            'cp_p_id'=>$this->bigInteger()->notNull(),

        ],$tableOptions);

            $this->addForeignKey("competence_profile","{{%CompetenceProfile}}",'cp_com_id',"{{%CompetenceController}}","com_id",'CASCADE');
            $this->addForeignKey("competence_profile_user","{{%CompetenceProfile}}","cp_p_id","{{%Profile}}","p_user_id","CASCADE");
    }
    public function down()
    {
        $this->dropTable('{{%CompetenceController}}');
        $this->dropTable('{{%CompetenceProfile}}');
        $this->dropForeignKey("competence_profile","{{%CompetenceProfile}}");
        $this->dropForeignKey("competence_profile_user","{{%CompetenceProfile}}");

    }

}
