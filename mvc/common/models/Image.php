<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Image".
 *
 * @property int $i_id
 * @property int $i_user_id
 * @property string $i_image
 *
 * @property Profile $iUser
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['i_user_id','i_image'], 'required'],
            [['i_user_id'], 'default', 'value' => null],
            [['i_user_id'], 'integer'],
            [['i_image'],'file','extensions' => 'png, jpg'],
            [['i_image'], 'string', 'max' => 255],
            [['i_image'], 'safe'],
            [['i_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['i_user_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'i_id' => 'I ID',
            'i_user_id' => 'I User ID',
            'i_image' => 'I Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getIUser()
    {
        return $this->hasOne(Profile::className(), ['p_user_id' => 'i_user_id']);
    }
}
