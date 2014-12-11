<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
<<<<<<< HEAD
use Yii;
=======
use yii\helpers\Security;
>>>>>>> 5214b3a... initial commit with a little structure
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
<<<<<<< HEAD
    // use \common\models\traits\UserMailer;

=======
>>>>>>> 5214b3a... initial commit with a little structure
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_USER = 10;

<<<<<<< HEAD
    public $oldPassword;
    public $newPassword;
    public $newPasswordCheck;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

=======
>>>>>>> 5214b3a... initial commit with a little structure
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
<<<<<<< HEAD
             // ['status', 'default', 'value' => self::STATUS_ACTIVE],
             // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

             // ['role', 'default', 'value' => self::ROLE_USER],
             // ['role', 'in', 'range' => [self::ROLE_USER]],
=======
             ['status', 'default', 'value' => self::STATUS_ACTIVE],
             ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

             ['role', 'default', 'value' => self::ROLE_USER],
             ['role', 'in', 'range' => [self::ROLE_USER]],
>>>>>>> 5214b3a... initial commit with a little structure
         ];
     }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

<<<<<<< HEAD
    public function canDo($action) {
      if (isset(Yii::$app->params['roles'][$action])) {
            
            $roles = $this->getGroups();
            // if (!is_array($roles)) {
                // Yii::app()->request->redirect(Yii::app()->createUrl('site/index'));
            // }

            foreach ($roles as $role) {
                if (in_array($role, Yii::$app->params['roles'][$action])) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getGroups() {
        $meta = json_decode($this->meta, true);
        if (!isset($meta['groups'])) return [];
        return $meta['groups'];
    }

    public function getNotificationSettings() {
        $meta = json_decode($this->meta, true);
        if (!isset($meta['notifications'])) return [];
        return $meta['notifications'];   
    }

    public function setNotificationSettings($type, $value) {
        $settings = $this->getNotificationSettings();
        $settings[$type] = $value;
        $meta = json_decode($this->meta,true);
        $meta['notifications'] = $settings;
        $this->meta = json_encode($meta);
        $this->save(false);
    }

=======
>>>>>>> 5214b3a... initial commit with a little structure
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
<<<<<<< HEAD
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
=======
        return Security::validatePassword($password, $this->password_hash);
>>>>>>> 5214b3a... initial commit with a little structure
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
<<<<<<< HEAD
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
=======
        $this->password_hash = Security::generatePasswordHash($password);
>>>>>>> 5214b3a... initial commit with a little structure
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
<<<<<<< HEAD
        $this->auth_key = Yii::$app->getSecurity()->generateRandomKey();
=======
        $this->auth_key = Security::generateRandomKey();
>>>>>>> 5214b3a... initial commit with a little structure
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
<<<<<<< HEAD
        $this->password_reset_token = Yii::$app->getSecurity()->generateRandomKey() . '_' . time();
=======
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
>>>>>>> 5214b3a... initial commit with a little structure
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
<<<<<<< HEAD

    public function wantsNewInvoiceMessage() {
        $settings = $this->getNotificationSettings();
        return isset($settings['newInvoice']) && $settings['newInvoice'] ? 1 : 0;
    }

    public function wantsUpdateInvoiceMessage() {
        $settings = $this->getNotificationSettings();
        return isset($settings['updateInvoice']) && $settings['updateInvoice'] ? 1 : 0;
    }

    public function wantsPaidMessage() {
        $settings = $this->getNotificationSettings();
        return isset($settings['paid']) && $settings['paid'] ? 1 : 0;
    }

    public function wantsApprovedMessage() {
        $settings = $this->getNotificationSettings();
        return isset($settings['approved']) && $settings['approved'] ? 1 : 0;
    }
}
=======
}
>>>>>>> 5214b3a... initial commit with a little structure
