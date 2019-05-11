<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Archive".
 *
 * @property int $a_id
 * @property int $a_status
 * @property int $a_con_id
 * @property string $a_date
 * @property string $a_hash_video
 *
 * @property Consultation $aCon
 */
class Archive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Archive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a_status', 'a_con_id'], 'required'],
            [['a_status', 'a_con_id'], 'default', 'value' => null],
            [['a_status', 'a_con_id'], 'integer'],
            [['a_date'], 'safe'],
            [['a_hash_video','a_reason'], 'string', 'max' => 255],
            [['a_con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::className(), 'targetAttribute' => ['a_con_id' => 'con_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'a_status' => 'A Status',
            'a_con_id' => 'A Con ID',
            'a_date' => 'A Date',
            'a_hash_video' => 'A Hash Video',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACon()
    {
        return $this->hasOne(Consultation::className(), ['con_id' => 'a_con_id']);
    }

    public function fields()
    {

        return ArrayHelper::merge(parent::fields(),[
            'aCon',
        ]);
    }


    public function extraFields()
    {
        return [
            'aCon'
        ];
    }
}
