<?php
namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tokens".
 *
 * @property integer $t_id
 * @property integer $t_user_id
 * @property string $t_token
 * @property string $t_expire_time
 *
 * @property User $id0
 */
class Token extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Token';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['t_user_id', 'token'], 'required'],
            [['t_user_id'], 'integer'],
            ['t_token','safe'],
            [['t_expire_time'], 'safe'],
            [['t_token'], 'string', 'max' => 255],
            [['t_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 't_id']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            't_id' => 'ID',
            't_user_id' => 'User ID',
            't_token' => 'Token',
            't_expire_time' => 'Time',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 't_id']);
    }
    /**
     * @inheritdoc
     * @return TokenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TokenQuery(get_called_class());
    }

    public function generateToken($expire)
    {
        $token = Yii::$app->jwt->getBuilder()
            ->setIssuer('http://example.com') // Configures the issuer (iss claim)
            ->setAudience('http://example.org') // Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setNotBefore(time() + 60) // Configures the time before which the token cannot be accepted (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('uid', 1) // Configures a new claim, called "uid"
            ->getToken(); // Retrieves the generated token


        $token->getHeaders(); // Retrieves the token headers
        $token->getClaims(); // Retrieves the token claims

    }
}