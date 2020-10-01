<?php
$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));
$activationCode = end($uri);
 print_r($activationCode);

if ($activationCode) {
  $query = $db->prepare('SELECT * FROM users WHERE user_token = :token');
  $query->execute([
    'token' => $activationCode
  ]);
  $row = $query->fetch(PDO::FETCH_ASSOC);
  if ($row) {
    $activate = User::setActivationCode($row['user_id'], 1);
    if ($activate) {
      $row['user_activation'] = 1;
      User::Login($row);
      header('Location:'.site_url('?msg=activation_success'));
    }else {
      die('Hesabınız Aktif Hale Gelemedi.');
    }
  }else {
    header('Location:' . site_url());
  }
}
 ?>
