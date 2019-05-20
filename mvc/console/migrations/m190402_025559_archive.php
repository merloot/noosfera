<?php

use yii\db\Migration;

/**
 * Class m190402_025559_archive
 */
class m190402_025559_archive extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Archive}}', [
            'a_id' => $this->primaryKey(),
            'a_status'=> $this->tinyInteger()->notNull(),
            'a_con_id'=> $this->integer()->notNull(),
            'a_date'=> $this->timestamp(),
            'a_hash_video'=> $this->string(),

        ], $tableOptions);

        $this->addForeignKey('Archive_Consultation','Archive','a_con_id','Consultation','con_id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('Archive_Consultation','Archive');
        $this->dropTable('Archive');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190402_025559_archive cannot be reverted.\n";

        return false;
    }
    */
}
