<?php
// echo "<pre>";
// print_r($_SESSION);
if ($_SESSION['activation'] == 0 && $_SESSION['login'] == 1) {
  $uri = array_filter(explode("=", $_SERVER['REQUEST_URI']));
  $send = end($uri);
  if ($send == 'send') {
    if (date('Y-m-d H:i:s') >= $_SESSION['update']) {
      $send = User::resendActivation($_SESSION['id']);
      if ($send) {
        $success = 'Aktivasyon mailiniz tekrar gönderilmiştir.';
      }else {
        $error = 'Bir sorun oluştu aktivasyon maili göderilemedi. Lütfen daha sonra tekrar deneyin.';
      }
    }else {
      $error = 'Aktivasyon mailini tekrar gönderebileceğiniz tarih: '.$_SESSION['update'];
    }

  }
  require realpath('.').'/view/resend-activation.php';
}else {
  header('Location:'.site_url());
}
?>
