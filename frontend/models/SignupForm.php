<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use backend\models\Roll;
use Yii;

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
        }else
        
        $user = new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->roll_id = $this->roll_id;
        $user->JMBG = $this->JMBG;
        $user->setPassword($this->JMBG);
        $user->generateAuthKey();
        
    //Sacuvamo podatke za kreiranog korisnika u tabeli user.
    //Ako su podaci sacuvani dohvati id kreiranog korisnika i id role
      if($user->save()){
        $roll_id = $this->roll_id;
        $user_id = $user->getId();

        //U zavisnosti od id role koja je dodeljena kreiranom korisniku, posalji odgovarajuci parametar funkciji givePermissionBasedOnRolle
        switch ($roll_id) {
            case '1':
                $this->givePermissionsBasedOnRolle($roll_id, $user_id);
                break;
            case '2':
                $this->givePermissionsBasedOnRolle($roll_id, $user_id);
                break;
            case' 3':
                $this->givePermissionsBasedOnRolle($roll_id, $user_id);
                break;
            case '4':
                $this->givePermissionsBasedOnRolle($roll_id, $user_id);
                break;
        }
        Yii::$app->session->setFlash('success', "User created successfully.");
      } else{
        Yii::$app->session->setFlash('error', "Something went wrong! Check your data and try again!"); 
      }
    }

    //Dodeli korisniku odgovarajuce privilegije u zavisnosti od role koja mu je dodeljena
    function givePermissionsBasedOnRolle($roll_id, $user_id){
        $auth = \Yii::$app->authManager;

        //Dohvati naziv role preko id-ja
        $roll = Roll::find()->select('title')->where(['id'=>$roll_id])->one();

        //Dodeli korisniku odgovarajuce privilegije koje su definisane u tabeli auth_item za odgovarajucu rolu
        $userRole = $auth->getRole($roll);
        $auth->assign($userRole,$user_id );
      }
}
