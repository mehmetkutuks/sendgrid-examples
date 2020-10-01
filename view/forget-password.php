<?php require 'static/header.php' ?>

<?php if (isset($error)): ?>
    <div class="error">
        <?= $error ?>
    </div>
<?php endif; ?>

<?php if (isset($success)): ?>
    <div class="success">
        <?= $success ?>
    </div>
<?php endif; ?>

    <form action="<?= site_url('forget-password') ?>" method="post">
        <h4>Şifremi Unuttum</h4>
        <p>
            Aşağıdaki güvenlik adımlarını geçerek, yeni bir şifre talebinde bulunabilirsiniz.
        </p>
        <label for="name_or_email">E-posta Adresiniz ya da Kullanıcı Adınız</label>
        <input type="text" name="name_or_email" value="<?=post('name_or_email')?>" id="name_or_email"><br><br>
        <label for="question">Güvenlik Sorunuz</label>
        <select name="question" id="question">
            <?php foreach (questions() as $key => $question): ?>
                <option <?=post('question') == $key ? ' selected ' : null ?> value="<?= $key ?>"><?= $question ?></option>
            <?php endforeach; ?>
        </select> <br><br>
        <label for="answer">Cevabınız</label>
        <input type="text" name="answer" value="<?=post('answer')?>" id="answer"> <br><br>
        <input type="hidden" name="submit" value="1">
        <button type="submit">Gönder</button>
    </form>

<?php require 'static/footer.php' ?>
