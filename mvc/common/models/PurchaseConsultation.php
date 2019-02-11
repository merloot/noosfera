<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "PurchaseConsultation".
 *
 * @property int $pc_id
 * @property int $pc_user_id
 * @property int $pc_con_id
 * @property string $pc_title
 * @property string $pc_description
 * @property string $pc_date
 * @property string $pc_begin_time
 * @property string $pc_end_time
 * @property string $pc_price
 * @property bool $pc_like
 *
 * @property Consultation $pcCon
 * @property Profile $pcUser
 */
class PurchaseConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PurchaseConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pc_user_id', 'pc_con_id', 'pc_title'], 'required'],
            [['pc_user_id', 'pc_con_id'], 'default', 'value' => null],
            [['pc_user_id', 'pc_con_id'], 'integer'],
            [['pc_date', 'pc_begin_time', 'pc_end_time'], 'safe'],
            [['pc_price'], 'number'],
            [['pc_like'], 'boolean'],
            [['pc_title', 'pc_description'], 'string', 'max' => 255],
            [['pc_con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::className(), 'targetAttribute' => ['pc_con_id' => 'con_id']],
            [['pc_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['pc_user_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pc_id' => 'Pc ID',
            'pc_user_id' => 'Pc User ID',
            'pc_con_id' => 'Pc Con ID',
            'pc_title' => 'Pc Title',
            'pc_description' => 'Pc Description',
            'pc_date' => 'Pc Date',
            'pc_begin_time' => 'Pc Begin Time',
            'pc_end_time' => 'Pc End Time',
            'pc_price' => 'Pc Price',
            'pc_like' => 'Pc Like',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcCon()
    {
        return $this->hasOne(Consultation::className(), ['con_id' => 'pc_con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcUser()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'pc_user_id']);
    }
}
