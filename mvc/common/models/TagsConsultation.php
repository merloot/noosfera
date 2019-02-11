<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TagsConsultation".
 *
 * @property int $tc_id
 * @property int $tc_tag_id
 * @property int $tc_con_id
 */
class TagsConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TagsConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tc_tag_id', 'tc_con_id'], 'required'],
            [['tc_tag_id', 'tc_con_id'], 'default', 'value' => null],
            [['tc_tag_id', 'tc_con_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tc_id' => 'Tc ID',
            'tc_tag_id' => 'Tc Tag ID',
            'tc_con_id' => 'Tc Con ID',
        ];
    }
}
