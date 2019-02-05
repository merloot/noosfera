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
 * @property int $p_rating
 * @property string $p_image
 * @property int $p_id_profile_competence
 * @property bool $p_gender
 * @property string $p_date
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
            [['p_user_id', 'p_name', 'p_second_name', 'p_family', 'p_gender', 'p_date'], 'required'],
            [['p_user_id', 'p_rating', 'p_id_profile_competence'], 'default', 'value' => null],
            [['p_user_id', 'p_rating', 'p_id_profile_competence'], 'integer'],
            [['p_gender'], 'boolean'],
            [['p_date'], 'safe'],
            [['p_name', 'p_second_name', 'p_family'], 'string', 'max' => 50],
            [['p_description', 'p_image'], 'string', 'max' => 255],
            [['p_id_profile_competence'], 'unique'],
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
            'p_rating' => 'P Rating',
            'p_image' => 'P Image',
            'p_id_profile_competence' => 'P Id Profile Competence',
            'p_gender' => 'P Gender',
            'p_date' => 'P Date',
        ];
    }
}
