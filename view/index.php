<?php require 'static/header.php'; ?>
<?php if (get('msg')=='activation_success'): ?>
<div class="success">
  Aktivasyon işlemi başarılı bir şekilde tamamlanmıştır.
</div>
<?php endif; ?>
<?php if (session('login')): ?>
  Hoşgeldin, <strong><?= session('username'); ?></strong>
  <a href="<?= site_url('logout') ?>">[Çıkış Yap]</a>
  <br><br>
  <?php if (session('activation') == 0): ?>
    <div class="info">
      Aktivasyon mailini tekrar almak için <a href="<?= site_url('resend-activation') ?>">tıklayınız.</a>
    </div>
  <?php endif; ?>
<?php else: ?>
<a href="<?= site_url('register') ?>">Kayıt Ol</a> | <a href="<?= site_url('login') ?>">Giriş Yap</a> | <a href="<?= site_url('forget-password') ?>">Şifremi Unuttum</a>
<?php endif; ?>
 <?php require 'static/footer.php'; ?>
