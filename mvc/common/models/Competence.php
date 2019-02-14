<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "CompetenceController".
 *
 * @property int $com_id
 * @property string $competence
 */
class Competence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CompetenceController';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competence'], 'required'],
            [['competence'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'competence' => 'CompetenceController',
        ];
    }
}
