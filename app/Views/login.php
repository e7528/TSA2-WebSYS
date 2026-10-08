<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-intro"><div><p class="eyebrow">TASK MANAGEMENT</p><h1>Sign in<span class="accent">.</span></h1><p class="lead">Sign in to create, edit, and archive tasks.</p></div></section>
<section class="panel form-panel" aria-labelledby="login-heading">
    <h2 id="login-heading">Your account</h2>
    <?php if ($error !== null): ?><p class="form-error" role="alert"><?= esc($error) ?></p><?php endif ?>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required maxlength="50" autocomplete="username" value="<?= esc($username, 'attr') ?>">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        <div class="form-actions"><button class="primary-button" type="submit">Sign in</button></div>
    </form>
</section>
<?= $this->endSection() ?>
