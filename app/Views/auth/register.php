<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container">
        <h1><?= lang('Auth.register') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= implode('<br>', array_map('esc', $errors)) ?></div>
        <?php endif; ?>

        <form action="/register" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('Auth.email') ?></label>
                <input type="email" name="email" value="<?= old('email') ?>" required>
                <div class="field-hint"><?= lang('Auth.email_hint') ?></div>
            </div>
            <div class="form-group">
                <label><?= lang('Auth.password') ?></label>
                <input type="password" name="password" required>
                <div class="field-hint"><?= lang('Auth.password_hint') ?></div>
            </div>
            <div class="form-group">
                <label><?= lang('User.name') ?></label>
                <input type="text" name="name" value="<?= old('name') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('User.location') ?></label>
                <input type="text" name="location" value="<?= old('location') ?>" placeholder="e.g. Curaçao">
            </div>
            <div class="form-group">
                <label><?= lang('User.certification_level') ?></label>
                <input type="text" name="certification_level" value="<?= old('certification_level') ?>" placeholder="e.g. PADI Divemaster">
            </div>
            <div class="form-group">
                <label><?= lang('User.bio') ?></label>
                <textarea name="bio" rows="3"><?= old('bio') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.create_account') ?></button>
        </form>

        <p style="margin-top:1rem; text-align:center; color:var(--color-text-muted); font-size:0.9rem;">
            <?= lang('Auth.have_account') ?> <a href="/login"><?= lang('Auth.sign_in') ?></a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>
