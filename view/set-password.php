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
<form action="<?= site_url('set-password') ?>" method="post">
  <h4>Şifreni Sıfırla</h4>
  <p>
    Merhaba <?= $row['user_name'] ?>, yeni şifreni buradan belirleyebilirsiniz.
  </p>
  <label for="password">Yeni Şifreniz:</label>
  <input type="password" name="password" value="<?= post('password') ?>" id="password">
  <br><br>
  <label for="repassword">Yeni Şifreniz(Tekrar):</label>
  <input type="repassword" name="repassword" value="<?= post('repassword') ?>" id="password">
  <input type="hidden" name="submit" value="1">
  <br><br>
  <button type="submit">Gönder</button>
</form>
<?php require 'static/footer.php'; ?>
