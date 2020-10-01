<?php require 'static/header.php'; ?>
<?php if (isset($error)): ?>
  <div class="error">
    <?= $error; ?>
  </div>
<?php endif; ?>
<?php if (isset($success)): ?>
  <div class="success">
    <?= $success; ?>
  </div>
<?php endif; ?>
<form action="<?= site_url('login') ?>" method="post">
  <h4>Giriş Yap</h4>
  <label for="username">Kullanıcı Adı:</label>
  <input type="text" name="username" value="<?= post('username') ?>" id="username">
  <label for="password">Şifreniz:</label>
  <input type="password" name="password" id="password">
  <br><br>
  <button name="submit" type="submit">Giriş Yap</button>
</form>
<?php require 'static/footer.php'; ?>
