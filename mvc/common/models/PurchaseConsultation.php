<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "PurchaseConsultation".
 *
 * @property int $pc_id
 * @property int $pc_user_id
 * @property int $pc_con_id
 * @property string $pc_title
 * @property string $pc_description
 * @property string $pc_date
 * @property string $pc_begin_time
 * @property string $pc_end_time
 * @property string $pc_price
 * @property bool $pc_like
 * @property bool $pc_com_id
 *
 * @property Consultation $pcCon
 * @property Profile $pcUser
 */
class PurchaseConsultation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PurchaseConsultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pc_title'],'trim'],
            [['pc_title'], 'required'],
            [['pc_com_id'],'required'],
            [['pc_user_id', 'pc_com_id'], 'default', 'value' => null],
            [['pc_user_id', 'pc_com_id'], 'integer'],
            [['pc_date'], 'safe'],
            [['pc_begin_time','pc_end_time'], 'time','validateDate'],
            [['pc_price'], 'number'],
            [['pc_like'], 'boolean'],
            [['pc_title'],'string','max'=>50],
            [['pc_description'], 'string', 'max' => 250],
            [['pc_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['pc_user_id' => 'p_user_id']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pc_id' => 'Pc ID',
            'pc_user_id' => 'Pc User ID',
            'pc_con_id' => 'Pc Con ID',
            'pc_title' => 'Pc Title',
            'pc_description' => 'Pc Description',
            'pc_date' => 'Pc Date',
            'pc_begin_time' => 'Pc Begin Time',
            'pc_end_time' => 'Pc End Time',
            'pc_price' => 'Pc Price',
            'pc_like' => 'Pc Like',
            'pc_com_id'=>'Pc competence id'
        ];
    }

    public function validateDate(){

        $currentDate = Yii::$app->getFormatter()->asTime(time());

        if ($this->pc_begin_time > $this->pc_end_time){
            $this->addError('pc_begin_time', '"Проверьте дату окончания"');
            $this->addError('sc_end_time', '"Дата окончания", не может быть раньше "даты начала');
        }

        if ($this->isNewRecord){
            if ($currentDate > $this->pc_begin_time) {
                $this->addError('pc_begin_time', '"Дата начала", не может быть раньше текущей даты');
            }

            if ($currentDate > $this->pc_end_time){
                $this->addError('pc_end_time', '"Дата окончания", не может быть раньше текущей даты');
            }
        }

    }

    public function getTagCon()
    {

        return $this->hasMany(Tags::className(),[
            'tag_id'=>'tc_tag_id'])
            ->viaTable('TagsConsultation', [
                'tc_con_id' => 'pc_id'
            ]);

    }

    public function getConsultations()
    {

        return $this->hasMany(Consultation::className(), [
            'con_pc_id' => 'pc_id'
        ]);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPcUser()
    {

        return $this->hasOne(Profile::className(), [
            'p_user_id' => 'pc_user_id'
        ]);

    }


    public function getCountPc()
    {

        return PurchaseConsultation::find()
            ->where(['pc_type'=>1])
            ->count('pc_id');

    }

    public function getPcCom()
    {

        return $this->hasOne(Competence::className(), [
            'com_id'=>'pc_com_id'
        ]);

    }

    public function findById()
    {
        return PurchaseConsultation::find([
            'pc_id' => $this->primaryKey])
            ->one();

    }

    public function fields()
    {

        return ArrayHelper::merge(parent::fields(),[
            'pcCom',
            'pcUser',
            'tagCon',
            'countPc'
        ]);
    }

    public function extraFields()
    {
        return [
            'pcCom',
            'pcUser',
            'tagCon',
            'countPc'
        ];
    }

}
