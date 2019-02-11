<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Profile".
 *
 * @property int $p_id
 * @property int $p_user_id
 * @property string $p_name
 * @property string $p_description
 * @property string $p_image
 * @property bool $p_gender
 * @property string $p_date
 *
 * @property User $pUser
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_user_id', 'p_name'], 'required'],
            [['p_user_id'], 'default', 'value' => null],
            [['p_user_id'], 'integer'],
            [['p_gender'], 'boolean'],
            [['p_date'], 'safe'],
            [['p_name'], 'string', 'max' => 100],
            [['p_description', 'p_image'], 'string', 'max' => 255],
            [['p_user_id'], 'unique'],
            [['p_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['p_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_user_id' => 'P User ID',
            'p_name' => 'P Name',
            'p_description' => 'P Description',
            'p_image' => 'P Image',
            'p_gender' => 'P Gender',
            'p_date' => 'P Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUser()
    {
        return $this->hasOne(User::className(), ['id' => 'p_user_id']);
    }
}
