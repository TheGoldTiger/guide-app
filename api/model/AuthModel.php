<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class AuthModel extends Database
{
    public function logIn(string $email, string $password)
    {
      $this->query("SELECT id, hash FROM account WHERE email = :email");
      $this->bind(":email", $email);
      if ($account = $this->single()) {
        if (password_verify($password . $email, $account["hash"])) {
          $id = $account["id"];

            $token = hash("sha256", $id . time());
            $ip_bin = $_SERVER["REMOTE_ADDR"];

            $this->query("REPLACE INTO account_cookie (account, token, ip) VALUES (:a, :token, :ip)");
            $this->bind(":a", $id);
            $this->bind(":token", $token);
            $this->bind(":ip", $ip_bin);
            $this->execute();

            return $token;

        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public function getMe(string $token)
    {
      $ip_bin = $_SERVER["REMOTE_ADDR"];
      $this->query("SELECT a.id, a.email, a.permission FROM account_cookie AS c LEFT JOIN account AS a ON a.id = c.account WHERE c.token = :t && c.ip = :ip");
      $this->bind(":t", $token);
      $this->bind(":ip", $ip_bin);
      $result = $this->single();
      if($result != false && $result != ""){
        return $result;
      }else{
        return false;
      }

    }

    public function checkAuth(string $token)
    {
      $ip_bin = $_SERVER["REMOTE_ADDR"];
      $this->query("SELECT account FROM account_cookie WHERE token = :t && ip = :ip");
      $this->bind(":t", $token);
      $this->bind(":ip", $ip_bin);
      $result = $this->single();
      if($result != false && $result != ""){
        return true;
      }else{
        return false;
      }

    }

}
