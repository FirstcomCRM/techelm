<?php
namespace common\models;

use Yii;
use yii\base\Model;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            //['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $UserObject = new User();
            $UserCredentials = $UserObject->findIdByUsernameAndPassword($_POST['LoginForm']['username'], $_POST['LoginForm']['password']);
            if(!empty($UserCredentials)){
                Yii::$app->session->set('UserCredentials', $UserCredentials);

                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            }else{
                $this->addError('username','Please check your username.');
                $this->addError('password','Please check your password.');
                return false;
            }

        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {

        if ($this->_user === null) {

            $this->_user = User::findByUsername($this->username);

        }
        //  die('not');
        return $this->_user;
    }

    public function getUserCredentials($username, $password){
        return User::find()->where(['username'=>$username, 'password'=>$password]);
    }
}
