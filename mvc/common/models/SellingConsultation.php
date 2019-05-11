<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
/**
 * This is the model class for table "SellingConsultation".
 *
 * @property int $sc_id
 * @property int $sc_user_id
 * @property int $sc_con_id
 * @property string $sc_title
 * @property string $sc_description
 * @property string $sc_date
 * @property string $sc_begin_time
 * @property string $sc_end_time
 * @property string $sc_price
 * @property bool $sc_like
 * @property bool $sc_type
 *
 * @property Consultation $scCon
 * @property Profile $scUser
 */
class SellingConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'SellingConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sc_title'],'trim'],
            [['sc_title','sc_com_id'], 'required'],
            [['sc_type'], 'default', 'value' => 1],
            [['sc_user_id', 'sc_com_id'], 'default', 'value' => null],
            [['sc_user_id', 'sc_com_id','sc_type'], 'integer'],
            [['sc_date',], 'safe'],
            [['sc_begin_time','sc_end_time'],'time','validateDate'],
            [['sc_price'], 'number'],
            [['sc_like'], 'boolean'],
            [['sc_title'],'string','max'=>50],
            [['sc_description'], 'string', 'max' => 250],
            [['sc_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['sc_user_id' => 'p_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sc_id' => 'Sc ID',
            'sc_user_id' => 'Sc User ID',
            'sc_con_id' => 'Sc Con ID',
            'sc_title' => 'Sc Title',
            'sc_description' => 'Sc Description',
            'sc_date' => 'Sc Date',
            'sc_begin_time' => 'Sc Begin Time',
            'sc_end_time' => 'Sc End Time',
            'sc_price' => 'Sc Price',
            'sc_like' => 'Sc Like',
            'sc_com_id' => 'Sc Com ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getScCom()
    {

        return $this->hasOne(Competence::className(), [
            'com_id' => 'sc_com_id'
        ]);

    }


    public function getConsultations()
    {

        return $this->hasMany(Consultation::className(), [
            'con_sc_id' => 'sc_id'
        ]);

    }

    public function getCountSc()
    {

        return SellingConsultation::find()
            ->where([
                'sc_type'=>1])
            ->count('sc_id'
            );

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScUser()
    {

        return $this->hasOne(Profile::className(), [
            'p_user_id' => 'sc_user_id'
        ]);

    }

    public function getImage()
    {
        return $this->hasMany(Image::className(),[
            'i_user_id'=>'sc_user_id'
        ]);
    }
    public function getTagConsultation()
    {

        return $this->hasMany(Tags::className(),[
            'tag_id'=>'tc_tag_id'])
            ->viaTable('TagsConsultation', [
                'tc_sc_id' => 'sc_id'
            ]);

    }

    public function validateDate(){

        $currentDate = Yii::$app->getFormatter()->asTime(time());

        if ($this->sc_begin_time > $this->sc_end_time){
            $this->addError('sc_begin_time', '"Проверьте дату окончания"');
            $this->addError('sc_end_time', '"Дата окончания", не может быть раньше "даты начала');
        }

        if ($this->isNewRecord){
            if ($currentDate > $this->sc_begin_time) {
                $this->addError('sc_begin_time', '"Дата начала", не может быть раньше текущей даты');
            }

            if ($currentDate > $this->sc_end_time){
                $this->addError('sc_end_time', '"Дата окончания", не может быть раньше текущей даты');
            }
        }

    }

//    public function beforeValidate()
//    {
//
//        if ($this->sc_user_id !== CompetenceProfile::findOne(['cp_p_id'=>Yii::$app->request->get('sc_user_id')]))
//        {
//            $this->addError('sc_user_id', 'Access deny');
////            var_dump(SellingConsultation::findAll()->asArray());
//            return false;
//            return parent::beforeValidate(); // TODO: Change the autogenerated stub
//        }
//    }

//    public function beforeValidate()
//    {
//        if ($this->validate()
//        {
//            $this->addError('sc_user_id', 'Access deny');
////            var_dump(SellingConsultation::findAll()->asArray());
//            return false;
//            return parent::beforeValidate(); // TODO: Change the autogenerated stub
//        }
//    }

    public function findById()
    {
        return SellingConsultation::find([
            'sc_id' => $this->primaryKey])
            ->one();

    }


    public function fields()
    {

        return ArrayHelper::merge(parent::fields(),[
            'scCom',
            'scUser',
            'tagConsultation',
            'countSc',
            'image'
        ]);
    }

    public function getComSel()
    {

        return $this->hasMany(CompetenceProfile::className(),[
            'cp_p_id'=> 'sc_user_id'
        ]);

    }

    public function extraFields()
    {

        return [
            'scUser',
            'scCom',
            'tagConsultation',
            'countSc',
            'image'
        ];

    }

}
