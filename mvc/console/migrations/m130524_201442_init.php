<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%ConsultationController}}', [
            'con_id' => $this->primaryKey(),
            'con_pc_user_id'=>$this->bigInteger(),
            'con_sc_user_id' => $this->bigInteger(),
            'con_like'=>$this->boolean(),
            'con_date'=>$this->date(),
            'con_begin_time'=>$this->time(),
            'con_end_time'=>$this->time(),
            'con_price'=>$this->money(),
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
            'pc_price'=>$this->money(),
            'pc_like'=>$this->boolean(),
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
            'sc_price'=>$this->money(),
            'sc_like'=>$this->boolean(),


        ],$tableOptions);

        $this->addForeignKey("selling_consultation","{{%SellingConsultation}}","sc_con_id","{{%ConsultationController}}","con_id","CASCADE");
        $this->addForeignKey("selling_consultation_user","{{%SellingConsultation}}","sc_user_id","{{%Profile}}","p_user_id","CASCADE");

        $this->addForeignKey("purchase_consultation","{{%PurchaseConsultation}}","pc_con_id","{{%ConsultationController}}","con_id","CASCADE");
        $this->addForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}","pc_user_id","{{%Profile}}","p_user_id","CASCADE");

        $this->addForeignKey("tags_consultation_consultation",'{{%Tags}}',"tc_con_id","{{%ConsultationController}}","con_id","CASCADE");
        $this->addForeignKey("tags_consultation","{{%Tags}}",'tag_id',"{{%TagsConsultation}}","tc_id","CASCADE");


    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%ConsultationController}}');
        $this->dropTable('{{%SellingConsultation}}');
        $this->dropTable('{{%PurchaseConsultation}}');
        $this->dropForeignKey("selling_consultation","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation","{{%PurchaseConsultation}}");
        $this->dropForeignKey("selling_consultation_user","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}");
    }
}
