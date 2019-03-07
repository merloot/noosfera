<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "CompetenceProfile".
 *
 * @property int $cp_id
 * @property int $cp_com_id
 * @property int $cp_p_id
 *
 * @property Competence $cpCom
 * @property Profile $cpP
 */
class CompetenceProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CompetenceProfile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['cp_com_id'], 'required'],
            [['cp_com_id', 'cp_p_id'], 'default', 'value' => null],
            [['cp_com_id', 'cp_p_id'], 'integer'],
            [['cp_com_id', 'cp_p_id'], 'unique', 'targetAttribute' => ['cp_com_id', 'cp_p_id']],
            [['cp_com_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competence::className(), 'targetAttribute' => ['cp_com_id' => 'com_id']],
            [['cp_p_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['cp_p_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cp_id' => 'Cp ID',
            'cp_com_id' => 'Cp Com ID',
            'cp_p_id' => 'Cp P ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpCom()
    {
        return $this->hasOne(Competence::className(), ['com_id' => 'cp_com_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCpP()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'cp_p_id']);
    }



    public function extraFields()
    {
        return ['cpCom','cpP'];

    }
}

