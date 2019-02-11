<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Consultation".
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
            [['con_pc_user_id', 'con_sc_user_id'], 'default', 'value' => null],
            [['con_pc_user_id', 'con_sc_user_id'], 'integer'],
            [['con_like'], 'boolean'],
            [['con_date', 'con_begin_time', 'con_end_time'], 'safe'],
            [['con_price'], 'number'],
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
    public function getPurchaseConsultations()
    {
        return $this->hasMany(PurchaseConsultation::className(), ['pc_con_id' => 'con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellingConsultations()
    {
        return $this->hasMany(SellingConsultation::className(), ['sc_con_id' => 'con_id']);
    }
}
