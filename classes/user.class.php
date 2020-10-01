<?php
class User{
  public static function Register($data)
  {
    global $db;
    $data['user_password'] = md5($data['user_password']);
    $data['user_token'] = md5(uniqid());
    $data['user_update'] = date('Y-m-d H:i:s');

    $query = $db->prepare('INSERT INTO users SET user_name = :user_name, user_email = :user_email, user_password = :user_password,
      user_question = :user_question, user_answer = :user_answer, user_token = :user_token, user_update = :user_update');
      $insert = $query->execute($data);
      if ($insert) {
        return $data['user_token'];
      }else {
        return false;
      }
  }
  public static function Check($username, $email)
  {
    global $db;
    $query = $db->query('SELECT * FROM users WHERE user_name = "'.$username.'" || user_email = "'.$email.'"')->fetch(PDO::FETCH_ASSOC);
    if ($query) {
      return true;
      return false;
    }
  }

  public static function SendActivationMail($username, $user_email, $activation)
  {
    // echo "<pre>";
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("EMAIL ADRESS", "Mehmet KÜTÜK");
    $email->setSubject("Hesabınızı Onaylayın.");
    $email->addTo($user_email, $username);
    ob_start();
    require realpath('.').'/view/email.php';
    $output = ob_get_clean();
    $email->addContent(
        "text/html", $output
    );
    $sendgrid = new \SendGrid('API KEY');
        $response = $sendgrid->send($email);
        if ($response->statusCode() == 202) {
          return true;
        }else {
          return false;
        }
  }

  public static function resendActivation()
  {
    self::setActivationCode($_SESSION['id'], 0);
    $send = self::SendActivationMail($_SESSION['username'],$_SESSION['email'],$_SESSION['token']);
    return $send;
  }

  public static function setActivationCode($userId, $activation)
  {
    global $db;
    $query = $db->prepare('UPDATE users SET user_token = :token, user_activation = :activation, user_update = :user_update WHERE user_id = :user_id');
    $token = md5(uniqid());
    $date = date('Y-m-d H:i:s', strtotime('+1 minutes'));
    $_SESSION['update'] = $date;
    $_SESSION['token'] = $token;
    $result = $query->execute([
      'token' => $token,
      'user_id' => $userId,
      'user_update' => date('Y-m-d H:i:s', strtotime('+1 minutes')),
      'activation' => $activation
    ]);
    return $result;
  }

  public static function getUserInfo($username, $password)
  {
    global $db;
    $query = $db->prepare('SELECT * FROM users WHERE user_name = :username && user_password = :password');
    $query->execute([
      'username' => $username,
      'password' => md5($password)
    ]);
    return $query->fetch(PDO::FETCH_ASSOC);
  }

  public static function findForPassword($name_or_email, $question, $answer)
  {
    global $db;
    $query = $db->prepare('SELECT * FROM users WHERE (user_name = :name_or_email || user_email = :name_or_email) && user_question = :question && user_answer = :answer');
    $query->execute([
      'name_or_email' => $name_or_email,
      'question' => $question,
      'answer' => $answer
    ]);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  public static function Login($data)
  {
    $_SESSION['login'] = true;
    $_SESSION['id'] = $data['user_id'];
    $_SESSION['username'] = $data['user_name'];
    $_SESSION['email'] = $data['user_email'];
    $_SESSION['token'] = $data['user_token'];
    $_SESSION['activation'] = $data['user_activation'];
    $_SESSION['update'] = $data['user_update'];
  }

  public static function SendForgetPasswordEmail($user)
  {
    // echo "<pre>";
    global $db;
    $token = md5(uniqid());
    $date = date('Y-m-d H:i:s', strtotime('10 minutes'));
    $db->query('UPDATE users SET user_token ="' . $token . '", user_update = "' . $date . '" WHERE user_id = ' . $user['user_id'])->fetch(PDO::FETCH_ASSOC);
    $_SESSION['update'] = $date;
    $_SESSION['token'] = $token;
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("EMAIL ADRESS", "Mehmet KÜTÜK");
    $email->setSubject("Şifrenizi Sıfırlayın. - Mehmet KÜTÜK");
    $email->addTo($user['user_email'], $user['user_name']);
    ob_start();
    require realpath('.').'/view/forget-password-email.php';
    $output = ob_get_clean();
    $email->addContent(
        "text/html", $output
    );
    $sendgrid = new \SendGrid('API KEY');
        $response = $sendgrid->send($email);
        if ($response->statusCode() == 202) {
          return true;
        }else {
          return false;
        }
  }
}
?>
