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
<form action="<?= site_url('register') ?>" method="post">
  <h4>Kayıt Ol</h4>
  <label for="username">Kullanıcı Adı:</label>
  <input type="text" name="username" value="<?= post('username') ?>" id="username">
  <label for="password">Şifreniz:</label>
  <input type="password" name="password" id="password">
  <br><br>
  <label for="email">E-Posta Adresiniz:</label>
  <input type="text" name="email" value="<?= post('email') ?>" id="email">
  <br><br>
  <label for="question">Sorunuzu Seçiniz:</label>
  <select name="question" id="question">
    <?php foreach (questions() as $key => $question): ?>
      <option <?= post('question') == $key ? ' selected ': null ?> value="<?= $key ?>"><?= $question ?></option>
    <?php endforeach; ?>
  </select>
  <br><br>
  <label for="answer">Cevabınız:</label>
  <input type="text" name="answer" value="<?= post('answer') ?>" id="answer">
  <input type="hidden" name="submit" value="1">
  <br><br>
  <button type="submit">Kayıt Ol</button>
</form>
<?php require 'static/footer.php'; ?>
