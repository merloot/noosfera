<?php

use yii\db\Migration;

/**
 * Class m190211_031656_profile
 */
class m190211_031656_profile extends Migration
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
        echo "m190211_031656_profile cannot be reverted.\n";

        return false;
    }



    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%Profile}}', [
            'p_id' => $this->primaryKey(),
            'p_user_id'=>$this->bigInteger()->unique()->notNull(),
            'p_name' => $this->string(100)->notNull(),
            'p_description'=>$this->string(255),
            'p_image'=>$this->string(),
            'p_gender'=>$this->boolean(),
            'p_date'=>$this->date(),
            $this->addForeignKey("profile_user_id","{{%user}}",'id',"{{%Profile}}","p_user_id")
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%Profile}}');
        $this->dropForeignKey("profile_user_id","Profile");
    }

}
