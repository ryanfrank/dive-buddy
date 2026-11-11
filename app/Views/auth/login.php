<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container">
        <h1><?= lang('Auth.login') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= lang('Auth.login_failed') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('Auth.email') ?></label>
                <input type="email" name="email" value="<?= old('email') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('Auth.password') ?></label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sign_in') ?></button>
        </form>

        <div style="margin-top:1.5rem; padding-top:1.5rem; border-top:1px solid var(--color-border); text-align:center;">
            <p style="color:var(--color-text-muted); font-size:0.9rem;"><?= lang('Auth.or_connect_with') ?></p>
            <?php foreach ($oauthProviders as $provider): ?>
                <a href="/auth/oauth/<?= esc($provider) ?>" class="btn btn-ghost btn-block" style="margin-bottom:0.5rem;">
                    <?= lang('Auth.connect_with', [ucfirst($provider)]) ?>
                </a>
            <?php endforeach; ?>
            <?php if ($samlEnabled): ?>
                <a href="/auth/saml/login" class="btn btn-ghost btn-block"><?= lang('Auth.saml_login') ?></a>
            <?php endif; ?>
            <p style="margin-top:1rem; color:var(--color-text-muted); font-size:0.9rem;">
                <?= lang('Auth.no_account') ?> <a href="/register"><?= lang('Auth.create_account') ?></a>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
