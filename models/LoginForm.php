<?php 
namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model {
  public string $username = '';
  public string $password = '';

  public function rules(): array {
    return [
      'username' => [self::RULE_REQUIRED],
      'password' => [self::RULE_REQUIRED]
    ];
  }

  public function labels(): array {
    return [
      'username' => 'username',
      'password' => 'Password'
    ];
  }

  public function login() {
    $user = User::findOne(['username' => $this->username]);

    if (!$user) {
      $this->addError('username', 'Incorrect username or password');
      return false;
    }

    if (!password_verify($this->password, $user->password)) {
      $this->addError('password', 'Incorrect username or password');
      return false;
    }

    return Application::$app->login($user);
  }
}
?>