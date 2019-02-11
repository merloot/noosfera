<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Profile".
 *
 * @property int $p_id
 * @property int $p_user_id
 * @property string $p_name
 * @property string $p_second_name
 * @property string $p_family
 * @property string $p_description
 * @property string $p_image
 * @property bool $p_gender
 * @property string $p_date
 * @property int $p_id_profile_competence
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
            [['p_user_id', 'p_name', 'p_second_name', 'p_family', 'p_date'], 'required'],
            [['p_user_id', 'p_id_profile_competence'], 'default', 'value' => null],
            [['p_user_id', 'p_id_profile_competence'], 'integer'],
            [['p_name', 'p_second_name', 'p_family', 'p_description', 'p_image'], 'string'],
            ['p_image','file'],
            [['p_gender'], 'boolean'],
            [['p_date'], 'safe'],
            [['p_user_id'], 'unique'],
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
            'p_second_name' => 'P Second Name',
            'p_family' => 'P Family',
            'p_description' => 'P Description',
            'p_image' => 'P Image',
            'p_gender' => 'P Gender',
            'p_date' => 'P Date',
            'p_id_profile_competence' => 'P Id Profile Competence',
        ];
    }

//    public function beforeValidate()
//    {
//        if ($this->p_user_id != Yii::$app->user->getId())
//        {
//            $this->addError('p_user_id', 'Access deny');
//            return false;
//        }
//        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

