<?php require 'static/header.php'; ?>
<h4>Aktivasyon İşlemi</h4>
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
<a href="<?= site_url('resend-activation?=send') ?>">Tekrar Gönder.</a>
<?php require 'static/footer.php'; ?>
