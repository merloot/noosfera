<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Competence".
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
        return 'Competence';
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
            'competence' => 'Competence',
        ];
    }
}
