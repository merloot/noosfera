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
        ], $tableOptions);

        $this->addForeignKey('p_u_i','{{%Profile}}','p_user_id','{{%user}}','id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%Profile}}');
        $this->dropForeignKey('p_u_i','Profile');
    }

}
