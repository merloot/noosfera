<?php

namespace common\models;

use http\Params;
use Yii;

/**
 * This is the model class for table "ConsultationController".
 *
 * @property int $con_id
 * @property int $con_pc_user_id
 * @property int $con_sc_user_id
 * @property bool $con_like
 * @property string $con_date
 * @property string $con_begin_time
 * @property string $con_end_time
 * @property string $con_price
 *
 * @property PurchaseConsultation[] $purchaseConsultations
 * @property SellingConsultation[] $sellingConsultations
 */
class Consultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Consultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
{
    return [
        [['con_like'], 'boolean'],
        [['con_date', 'con_begin_time', 'con_end_time'], 'safe'],
        [['con_price'], 'number'],
        [['con_com_id', 'con_sc_id', 'con_pc_id'], 'default', 'value' => null],
        [['con_com_id', 'con_sc_id', 'con_pc_id'], 'integer'],
        [['con_title'], 'string', 'max' => 50],
        [['con_description'], 'string', 'max' => 250],
        [['con_pc_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseConsultation::className(), 'targetAttribute' => ['con_pc_id' => 'pc_id']],
        [['con_sc_id'], 'exist', 'skipOnError' => true, 'targetClass' => SellingConsultation::className(), 'targetAttribute' => ['con_sc_id' => 'sc_id']],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'con_id' => 'Con ID',
            'con_pc_user_id' => 'Con Pc User ID',
            'con_sc_user_id' => 'Con Sc User ID',
            'con_like' => 'Con Like',
            'con_date' => 'Con Date',
            'con_begin_time' => 'Con Begin Time',
            'con_end_time' => 'Con End Time',
            'con_price' => 'Con Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConPc()
    {
        return $this->hasOne(PurchaseConsultation::className(), [
            'pc_id' => 'con_pc_id'
        ]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */

    public function getConSc()
    {
        return $this->hasOne(SellingConsultation::className(), [
            'sc_id' => 'con_sc_id'
        ]);
    }

        public function getTagsConsultations()

        {

        return $this->hasMany(TagsConsultation::className(), [
            'tc_con_id' => 'con_id'
        ]);

        }
    public function beforeSave($insert)
    {
        if ($insert)
        {
            $this->con_title =$this->conSc->sc_title ;
//            $this->con_title = $this->conPc->pc_title;
            $this->con_description = $this->conSc->sc_description;
            $this->con_begin_time = $this->conSc->sc_begin_time;
            $this->con_end_time = $this->conSc->sc_end_time;
            $this->con_price = $this->conSc->sc_price;
            $this->con_date = $this->conSc->sc_date;
            return parent::beforeSave($insert); // TODO: Change the autogenerated stub

        }
    }
 }


