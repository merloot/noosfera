<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "SellingConsultation".
 *
 * @property int $sc_id
 * @property int $sc_user_id
 * @property int $sc_con_id
 * @property string $sc_title
 * @property string $sc_description
 * @property string $sc_date
 * @property string $sc_begin_time
 * @property string $sc_end_time
 * @property string $sc_price
 * @property bool $sc_like
 *
 * @property Consultation $scCon
 * @property Profile $scUser
 */
class SellingConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SellingConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sc_user_id', 'sc_con_id', 'sc_title'], 'required'],
            [['sc_user_id', 'sc_con_id'], 'default', 'value' => null],
            [['sc_user_id', 'sc_con_id'], 'integer'],
            [['sc_date', 'sc_begin_time', 'sc_end_time'], 'safe'],
            [['sc_price'], 'number'],
            [['sc_like'], 'boolean'],
            [['sc_title', 'sc_description'], 'string', 'max' => 255],
            [['sc_con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::className(), 'targetAttribute' => ['sc_con_id' => 'con_id']],
            [['sc_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['sc_user_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sc_id' => 'Sc ID',
            'sc_user_id' => 'Sc User ID',
            'sc_con_id' => 'Sc Con ID',
            'sc_title' => 'Sc Title',
            'sc_description' => 'Sc Description',
            'sc_date' => 'Sc Date',
            'sc_begin_time' => 'Sc Begin Time',
            'sc_end_time' => 'Sc End Time',
            'sc_price' => 'Sc Price',
            'sc_like' => 'Sc Like',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScCon()
    {
        return $this->hasOne(Consultation::className(), ['con_id' => 'sc_con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScUser()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'sc_user_id']);
    }
}
