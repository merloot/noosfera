<?php

use yii\db\Migration;

/**
 * Class m190511_100610_Image
 */
class m190511_100610_Image extends Migration
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
        $this->createTable('{{%Image}}', [
            'i_id' => $this->primaryKey(),
            'i_user_id'=>$this->integer()->notNull(),
            'i_image'=>$this->string(),
        ], $tableOptions);

        $this->addForeignKey('Image_Profile','Image','i_user_id','Profile','p_user_id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
     $this->dropTable('Image');
     $this->dropForeignKey('','');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190511_100610_Image cannot be reverted.\n";

        return false;
    }
    */
}
