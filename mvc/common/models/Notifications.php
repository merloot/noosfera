<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Notifications".
 *
 * @property int $n_id
 * @property int $n_selling_user_id
 * @property int $n_purchase_user_id
 * @property int $n_con_id
 * @property int $n_type
 * @property int $n_status
 *
 * @property Consultation $nCon
 * @property Profile $nSellingUser
 * @property Profile $nPurchaseUser
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['n_selling_user_id', 'n_purchase_user_id', 'n_con_id','n_type'], 'required'],
            [['n_selling_user_id', 'n_purchase_user_id', 'n_con_id',], 'default', 'value' => null],
            [['n_selling_user_id', 'n_purchase_user_id', 'n_con_id','n_status'], 'integer'],
            [['n_status'],'default','value'=>1],
            [['n_type'],'string'],
            [['n_con_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::className(), 'targetAttribute' => ['n_con_id' => 'con_id']],
            [['n_selling_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['n_selling_user_id' => 'p_user_id']],
            [['n_purchase_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['n_purchase_user_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'n_id' => 'N ID',
            'n_selling_user_id' => 'N Selling User ID',
            'n_purchase_user_id' => 'N Purchase User ID',
            'n_con_id' => 'N Con ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNCon()
    {
        return $this->hasOne(Consultation::className(), ['con_id' => 'n_con_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNSellingUser()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'n_selling_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNPurchaseUser()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'n_purchase_user_id']);
    }

    public function fields()
    {

        return ArrayHelper::merge(parent::fields(),[
            'nPurchaseUser',
            'nSellingUser',
            'nCon'
        ]);
    }

    public function extraFields()
    {
        return
            [
                'nPurchaseUser',
                'nSellingUser',
                'nCon'

            ];

    }


}
