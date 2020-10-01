<?php
if (session('login')) header('Location:'.site_url());
if (post('submit')) {
  $data = [
    'user_name' => post('username'),
    'user_password' => post('password'),
    'user_email' => post('email'),
    'user_question' => post('question'),
    'user_answer' => post('answer')
  ];
  if (empty($data['user_name'])) {
    $error = "Kullanıcı Adınızı Yazın.";
  }elseif (empty($data['user_password'])) {
    $error = "Lütfen Şifrenizi Giriniz.";
  }elseif (empty($data['user_email'])) {
    $error = "E-Posta Adresinizi Girin.";
  }elseif (empty($data['user_question'])) {
    $error = "Lütfen Soru Seçin.";
  }elseif (empty($data['user_answer'])) {
    $error = "Lütfen Soruyu Cevaplayınız.";
  }elseif (!preg_match('/^[0-9a-zA-Z]+$/', $data['user_name'])) {
    $error = "Kullanıcı Adınız Sadece Sayı ve Harflerden Oluşabilir.(Lütfen Türkçe Karakter Kullanmayınız.)";
  }elseif (!filter_var($data['user_email'],FILTER_VALIDATE_EMAIL)) {
    $error = "Lütfen Geçerli Bir E-Posta Giriniz.";
  }else {
    if (User::Check($data['user_name'], $data['user_email'])) {
      $error = "Kayıt olduğunuz kullanıcı adı veya E-Posta adresi kullanılıyor başka bir tane deneyin.";
    }
    else {
    $register = User::Register($data);
    if ($register) {
      $send = User::SendActivationMail($data['user_name'], $data['user_email'], $register);
      if ($send) {
        $success = "Kayıt olduğunuz E-Posta adresinize onay maili gönderdik, lütfen giriş yapmak için hesabınızı onaylayın.";
      }else {
        $error = "Bir sorun oluştu. Aktivasyon mailini gönderemedik.";
      }
    }else {
      $error = "Bir sorun oluştu.";
    }
  }
  }
}
require realpath('.').'/view/register.php';
 ?>
