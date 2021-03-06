<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "Tags".
 *
 * @property int $tag_id
 * @property string $tag_name
 *
 * @property TagsConsultation[] $tagsConsultations
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tag_name'], 'required'],
            [['tag_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag_name' => 'Tag Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagsConsultations()
    {
        return $this->hasMany(TagsConsultation::className(), [
            'tc_tag_id' => 'tag_id'
        ]);
    }

    public function extraFields()
    {
        return ['tagsConsultations'];
    }
}
