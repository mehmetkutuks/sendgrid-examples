<?php

if (session('login')) header('Location:' . site_url());

$uri = array_filter(explode('/', $_SERVER['REQUEST_URI']));
$token = end($uri);

if ($token && $token != 'forget-password') {

    $query = $db->prepare('SELECT * FROM users WHERE user_token = :token');
    $query->execute([
        'token' => $token
    ]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        header('Location:' . site_url());
        exit;
    }

    if (post('submit')){

        $password = post('password');
        $repassword = post('repassword');

        if (!$password || !$repassword){
            $error = 'Lütfen şifrenizi girin.';
        } elseif ($password != $repassword){
            $error = 'Girdiğiniz şifreler birbiriyle uyuşmuyor.';
        } else {

            $password = md5($password);
            $token = md5(uniqid());

            $query = $db->prepare('UPDATE users SET user_password = :password, user_token = :token
            WHERE user_id = :user_id');
            $update = $query->execute([
                'password' => $password,
                'token' => $token,
                'user_id' => $row['user_id']
            ]);

            if ($update){
                $success = 'Şifreniz başarıyla değiştirildi, <a href="' . site_url('login') . '">giriş yapmak için tıklayın.</a>';
                $_SESSION['token'] = $token;
            } else {
                $error = 'Bir sorun oluştu ve şifreniz değiştirilemedi.';
            }

        }

    }

    require realpath('.') . '/view/set-password.php';

} else {

    if (post('submit')) {

        $name_or_email = post('name_or_email');
        $question = post('question');
        $answer = post('answer');

        if (!$name_or_email || !$question || !$answer) {
            $error = 'Tüm alanları doldurup tekrar deneyin.';
        } else {

            $user = User::findForPassword($name_or_email, $question, $answer);
            if ($user) {

                if (session('update') && date('Y-m-d H:i:s') <= session('update')) {
                    $error = 'Bir sonraki şifre sıfırlama talebinizin tarihi: ' . session('update');
                } else {

                    $send = User::SendForgetPasswordEmail($user);
                    if ($send) {
                        $success = 'Sıfırlama talebiniz gönderildi.';
                    } else {
                        $error = 'Bir sorun oluştu hacı, gönderemedik.';
                    }

                }

            } else {
                $error = 'Bu bilgilere ait kullanıcı bulunamadı.';
            }

        }

    }

    require realpath('.') . '/view/forget-password.php';

}
