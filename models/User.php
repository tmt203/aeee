<?php 
namespace app\models;

use app\core\Application;
use app\core\UserModel;

class User extends UserModel {
  public int $id = 0;
  public string $firstName = '';
  public string $lastName = '';
  public string $username = '';
  public string $password = '';
  public string $confirmPassword = '';

  public function tableName(): string {
    return 'tbl_users';
  }

  public static function primaryKey(): string {
    return 'id';
  }

  public function attributes(): array {
    return ['firstName', 'lastName', 'username', 'password'];
  }

  public function labels(): array {
    return [
      'firstName' => 'First name',
      'lastName' => 'Last name',
      'username' => 'Username',
      'password' => 'Password',
      'confirmPassword' => 'Confirm password',
    ];
  }

  public function rules(): array {
    return [
      'firstName' => [self::RULE_REQUIRED],
      'lastName' => [self::RULE_REQUIRED],
      'username' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
      'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
      'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
    ];
  }

  public function getDisplayName(): string {
    return $this->firstName.' '.$this->lastName;
  }

  public function save() {
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }

  public function login() {
    $user = $this->findOne(['username' => $this->username]);
    if (!$user || !password_verify($this->password, $user->password)) {
      return false;
    }

    return Application::$app->login($user);
  }
}
?>