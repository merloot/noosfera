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

        $this->createTable('{{%Consultation}}', [
            'con_id' => $this->primaryKey(),
            'con_date'=> $this->date(),
            'con_begin_time'=>$this->time(),
            'con_end_time'=>$this->time(),
            'con_price'=>$this->money(),
            'con_title'=>$this->string(),
            'con_description'=>$this->string(),
            'con_sc_id'=>$this->integer(),
            'con_pc_id'=>$this->integer(),
            'con_type'=>$this->smallInteger(),
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
            'pc_com_id'=>$this->integer(),
            'pc_type'=>$this->smallInteger(),
        ],$tableOptions);

        $this->createTable('{{%SellingConsultation}}',[
            'sc_id'=>$this->primaryKey(),
            'sc_user_id'=>$this->bigInteger()->notNull(),
            'sc_title'=>$this->string()->notNull(),
            'sc_description'=>$this->string(),
            'sc_date'=>$this->date(),
            'sc_begin_time'=>$this->time(),
            'sc_end_time'=>$this->time(),
            'sc_price'=>$this->money(),
            'sc_like'=>$this->boolean(),
            'sc_com_id'=>$this->integer()->notNull(),
            'sc_type'=>$this->smallInteger(),
        ],$tableOptions);

        $this->createTable('{{%Profile}}', [
            'p_id' => $this->primaryKey(),
            'p_user_id'=>$this->bigInteger()->unique()->notNull(),
            'p_name' => $this->string(100)->notNull(),
            'p_description'=>$this->string(255),
            'p_image'=>$this->string(),
            'p_gender'=>$this->boolean(),
            'p_date'=>$this->date(),
        ], $tableOptions);

        $this->createTable('{{%CompetencePController}}', [
            'com_id' => $this->primaryKey(),
            'competence' => $this->string(100)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%CompetenceProfile}}',[
            'cp_id'=>$this->primaryKey(),
            'cp_com_id'=>$this->bigInteger()->notNull(),
            'cp_p_id'=>$this->bigInteger()->notNull(),
        ],$tableOptions);


        $this->addForeignKey("competence_profile","{{%CompetenceProfile}}",'cp_com_id',"{{%CompetencePController}}","com_id",'CASCADE');
        $this->addForeignKey("competence_profile_user","{{%CompetenceProfile}}","cp_p_id","{{%Profile}}","p_user_id","CASCADE");

        $this->addForeignKey('p_u_i','{{%Profile}}','p_user_id','{{%user}}','id', 'CASCADE');
        $this->addForeignKey("selling_consultation","{{%SellingConsultation}}","sc_con_id","{{%Consultation}}","con_id","CASCADE");
        $this->addForeignKey("selling_consultation_user","{{%SellingConsultation}}","sc_user_id","{{%Profile}}","p_user_id","CASCADE");

        $this->addForeignKey("purchase_consultation","{{%PurchaseConsultation}}","pc_con_id","{{%Consultation}}","con_id","CASCADE");
        $this->addForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}","pc_user_id","{{%Profile}}","p_user_id","CASCADE");

    }

    public function down()
    {
        $this->dropTable('{{%Profile}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%ConsultationController}}');
        $this->dropTable('{{%SellingConsultation}}');
        $this->dropTable('{{%PurchaseConsultation}}');
        $this->dropForeignKey("selling_consultation","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation","{{%PurchaseConsultation}}");
        $this->dropForeignKey("selling_consultation_user","{{%SellingConsultation}}");
        $this->dropForeignKey("purchase_consultation_user","{{%PurchaseConsultation}}");
        $this->dropForeignKey('p_u_i','Profile');
    }
}
