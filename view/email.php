<div style="padding: 30px; border:1px solid #ccc;">
  Sayın <strong><?= $username ?></strong>
  <br><br>
  <p>Sitemize kayıt olduğunuz için teşekkür ederiz aşağıdaki linke tıklayarak üyeliğiniz onaylayabilirsiniz.</p>
  <br><br>
  <a href="<?= site_url('activation/'.$activation) ?>"><?= site_url('activation/'.$activation) ?></a>
</div>
