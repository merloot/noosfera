<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TagsConsultation".
 *
 * @property int $tc_id
 * @property int $tc_tag_id
 * @property int $tc_con_id
 *
 * @property Consultation $tcCon
 * @property Tags $tcTag
 */
class TagsConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TagsConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tc_tag_id', ], 'required'],
            [['tc_tag_id', 'tc_pc_id','tc_sc_id'], 'default', 'value' => null],
            [['tc_tag_id', 'tc_pc_id','tc_sc_id'], 'integer'],
            [['tc_pc_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseConsultation::className(), 'targetAttribute' => ['tc_pc_id' => 'pc_id']],
            [['tc_sc_id'], 'exist', 'skipOnError' => true, 'targetClass' => SellingConsultation::className(), 'targetAttribute' => ['tc_sc_id' => 'sc_id']],
            [['tc_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tc_tag_id' => 'tag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tc_id' => 'Tc ID',
            'tc_tag_id' => 'Tc Tag ID',
            'tc_pc_id' => 'Tc Con ID',
            'tc_sc_id' => 'Tc Con ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScCon()
    {
        return $this->hasOne(SellingConsultation::className(),[
            'sc_id'=>'tc_sc_id'
        ]);
    }

    public function getPcCon()
    {
        return $this->hasOne(PurchaseConsultation::className(),[
            'pc_id'=>'tc_pc_id'
        ]);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTcTag()
    {
        return $this->hasOne(Tags::className(), [
            'tag_id' => 'tc_tag_id'
        ]);
    }

    public function extraFields()
    {
        return ['
        pcCon,
        scCon
        tcTag
        '];
    }


}
