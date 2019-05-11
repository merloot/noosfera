<?php

use yii\db\Migration;

/**
 * Class m190405_033428_notification
 */
class m190405_033428_notification extends Migration
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

        $this->createTable('{{%Notifications}}', [
            'n_id' => $this->primaryKey(),
            'n_selling_user_id'=> $this->integer()->notNull(),
            'n_purchase_user_id'=> $this->integer()->notNull(),
            'n_con_id'=> $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('NotificationsConsultations','Notifications','n_con_id','Consultation','con_id');
        $this->addForeignKey('NotificationsSelling','Notifications','n_selling_user_id','Profile','p_user_id');
        $this->addForeignKey('NotificationsPurchase','Notifications','n_purchase_user_id','Profile','p_user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("Notifications");
        $this->dropForeignKey('NotificationsConsultations','Notifications');
        $this->dropForeignKey('NotificationsSelling','Notifications');
        $this->dropForeignKey('NotificationsPurchase','Notifications');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190405_033428_notification cannot be reverted.\n";

        return false;
    }
    */
}
