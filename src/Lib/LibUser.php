<?php


namespace App\Lib;


class LibUser
{
  private $Db;

  public function __construct(LibDB $Db)
  {
    $this->Db = $Db;
  }

  public function checkPassword($user, $password)
  {
      $user = array_shift($user);
      $hash = $user['password'];

      if (password_verify($password, $hash))
      {
        //$this->setAuth($user['id']);
        return true;
      }
    return false;
  }

  public function logout() {
    $params = [
        $_COOKIE["key"]
    ];
    $this->Db->exec('DELETE from sessions WHERE `key` = ?', $params);
    setcookie('key', '', time() + 3600);
  }

  public function checkAuth($key): int // userId
  {
    if (isset($_COOKIE["key"])) {
      $params = [
          $_COOKIE["key"]
      ];
      $key = $this->Db->select('SELECT * from sessions WHERE `key` = ?; and exp_date > now()', $params);
      if ($key) {

        $key = array_shift($key);

        $current_date = date("Y-m-d H:i:s");
        $exp_date = $key['exp_date'];

        if ($current_date < $exp_date) {
          return true;
        } else {
          $this->Db->exec('DELETE from sessions WHERE `key` = ?', $params);
          return false;
        }
      }
      return false;
    }
    return false;
  }

  public function setAuth($user_id)
  {

//    $bytes = random_bytes(25);
//    $key = bin2hex($bytes);

//    setcookie("key", $key,time() + 3600);

    $exp_date = date("Y-m-d H:i:s", strtotime("+1 hours"));
    $params = [
        $key,
        $exp_date,
        $user_id
    ];
    $this->Db->exec('INSERT INTO sessions VALUES (?, ?, ?);', $params);
  }


  public function checkUsernameExists($username)
  {
    $params = [
        $username
    ];
    $user = $this->Db->select('SELECT * FROM User WHERE username = ?;', $params);
    if ($user) {
      return $user;
    }
    return false;
  }
}