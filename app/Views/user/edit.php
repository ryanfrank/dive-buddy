<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:600px; margin:0 auto;">
        <h1><?= lang('User.edit_profile') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= implode('<br>', array_map('esc', $errors)) ?></div>
        <?php endif; ?>

        <form action="/user/profile/update" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('User.name') ?></label>
                <input type="text" name="name" value="<?= old('name', $user['name'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('User.email') ?></label>
                <input type="email" name="email" value="<?= esc($user['email'] ?? '') ?>" readonly>
                <div class="field-hint"><?= lang('User.email_cannot_change') ?></div>
            </div>
            <div class="form-group">
                <label><?= lang('User.location') ?></label>
                <input type="text" name="location" value="<?= old('location', $user['location'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('User.certification_level') ?></label>
                <input type="text" name="certification_level" value="<?= old('certification_level', $user['certification_level'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('User.bio') ?></label>
                <textarea name="bio" rows="4"><?= old('bio', $user['bio'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('User.save_changes') ?></button>
            <a href="/user/profile" class="btn btn-ghost btn-block" style="margin-top:0.75rem;"><?= lang('User.cancel') ?></a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
