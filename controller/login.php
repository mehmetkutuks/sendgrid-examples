<?php
if (session('login')) header('Location:'.site_url());
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!$username) {
      $error = 'Lütfen kullanıcı adınızı giriniz.';
    }elseif (!$password) {
      $error = 'Lütfen şifrenizi giriniz.';
    }else {
      $info = User::getUserInfo($username, $password);
      if ($info) {
        User::Login($info);
        header('Location:'.site_url());
      }else {
        $error = 'Giriş yaparken sorun oluştu lütfen bilgileriniz kontrol edin.';
      }
    }

}


require realpath('.').'/view/login.php';
 ?>
