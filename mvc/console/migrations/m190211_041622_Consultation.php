<?php

use yii\db\Migration;

/**
 * Class m190211_041622_Consultation
 */
class m190211_041622_Consultation extends Migration
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
        echo "m190211_041622_Consultation cannot be reverted.\n";

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

        $this->createTable('{{%Consultation}}', [
            'con_id' => $this->primaryKey(),
            'con_pc_user_id'=>$this->bigInteger(),
            'con_sc_user_id' => $this->bigInteger(),
            'con_like'=>$this->boolean(),
            'con_date'=>$this->date(),
            'con_begin_time'=>$this->time(),
            'con_end_time'=>$this->time(),
            'con_price'=>$this->money()->check('con_price'> 0),

        ], $tableOptions);

        $this->createTable('{{%PurchaseConsultation}}',[
            'pc_id'=>$this->primaryKey(),
            'pc_user_id'=>$this->bigInteger()->notNull(),
            'pc_con_id'=>$this->bigInteger()->notNull(),
            'pc_title'=>$this->string()->notNull(),
            'pc_description'=>$this->string(),
            'pc_date'=>$this->date(),
            'pc_begin_time'=>$this->time(),
            'pc_end_time'=>$this->time(),
            'pc_price'=>$this->money()->check('pc_price' > 0),
            'pc_like'=>$this->boolean(),
            $this->addForeignKey("purchase_consultation","{{%PurchaseConsultation}}","pc_con_id","{{%Consultation}}","con_id"),
            $this->addForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}","pc_user_id","{{%Profile}}","p_user_id"),
        ],$tableOptions);

        $this->createTable('{{%SellingConsultation}}',[
            'sc_id'=>$this->primaryKey(),
            'sc_user_id'=>$this->bigInteger()->notNull(),
            'sc_con_id'=>$this->bigInteger()->notNull(),
            'sc_title'=>$this->string()->notNull(),
            'sc_description'=>$this->string(),
            'sc_date'=>$this->date(),
            'sc_begin_time'=>$this->time(),
            'sc_end_time'=>$this->time(),
            'sc_price'=>$this->money()->check('sc_price' > 0),
            'sc_like'=>$this->boolean(),
            $this->addForeignKey("selling_consultation","{{%SellingConsultation}}","sc_con_id","{{%Consultation}}","con_id"),
            $this->addForeignKey("selling_consultation_user","{{%SellingConsultation}}","sc_user_id","{{%Profile}}","p_user_id"),

        ],$tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%Consultation}}');
        $this->dropTable('{{%SellingConsultation}}');
        $this->dropTable('{{%PurchaseConsultation}}');
        $this->dropForeignKey("selling_consultation","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation","{{%PurchaseConsultation}}");
        $this->dropForeignKey("selling_consultation_user","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}");
    }

}
