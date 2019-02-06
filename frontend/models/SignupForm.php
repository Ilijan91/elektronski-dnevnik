<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $roll_id;
    public $JMBG;
  
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            // ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['first_name', 'string','max'=>100,],
            ['last_name', 'string','max'=>100,],
            ['roll_id', 'integer',],
            ['JMBG', 'integer', 'min' => 13]
            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->roll_id = $this->roll_id;
        $user->JMBG = $this->JMBG;
        $user->setPassword($this->JMBG);
        $user->generateAuthKey();
        
        // $auth = \Yii::$app->authManager;
        // $userRole = $auth->getRole($user->roll_id);
        // $auth->assign($userRole, $user->getId());

        return $user->save() ? $user : null;
    }
}
