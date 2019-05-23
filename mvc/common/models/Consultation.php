<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ConsultationController".
 *
 * @property int $con_id
 * @property int $con_pc_id
 * @property int $con_sc_id
 * @property string $con_date
 * @property string $con_begin_time
 * @property string $con_end_time
 * @property string $con_price
 * @property string $con_title
 * @property string $con_description
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
        [['con_date', 'con_begin_time', 'con_end_time'], 'safe'],
        [['con_price'], 'number'],
        [['con_sc_id', 'con_pc_id','con_type'], 'default', 'value' => null],
        [['con_sc_id', 'con_pc_id','con_type'], 'integer'],
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
            'con_pc_id' => 'Con Pc ID',
            'con_sc_id' => 'Con Sc ID',
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

    public function getArc()
    {
        return $this->hasMany(Archive::className(),[
           'a_con_id'=>'con_id'
        ]);
    }

    public function fields()
    {

        return ArrayHelper::merge(parent::fields(),[
            'conSc',
            'conPc',
        ]);
    }

    public function findById()
    {
        return Consultation::find([
            'con_id' => $this->primaryKey])
            ->one();

    }

    public function extraFields()
    {
        return [
            'conSc',
            'conPc',
            'tagsConsultations',
            'arc'
        ];
    }


    public function beforeSave($insert)
    {
        if ($insert)
        {
            $this->con_title =$this->conSc->sc_title ;
            $this->con_description = $this->conSc->sc_description;
            $this->con_begin_time = $this->conSc->sc_begin_time;
            $this->con_end_time = $this->conSc->sc_end_time;
            $this->con_price = $this->conSc->sc_price;
            $this->con_date = $this->conSc->sc_date;
            return parent::beforeSave($insert); // TODO: Change the autogenerated stub

        }
    }
 }



