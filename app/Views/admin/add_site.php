<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:600px; margin:0 auto;">
        <h1><?= lang('Admin.add_site') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= implode('<br>', array_map('esc', $errors)) ?></div>
        <?php endif; ?>

        <form action="/admin/sites/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('DiveSite.name') ?></label>
                <input type="text" name="name" value="<?= old('name') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('DiveSite.location') ?></label>
                <input type="text" name="location" value="<?= old('location') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('DiveSite.country') ?></label>
                <input type="text" name="country" value="<?= old('country') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('DiveSite.description') ?></label>
                <textarea name="description" rows="3"><?= old('description') ?></textarea>
            </div>
            <div class="form-group">
                <label><?= lang('DiveSite.difficulty') ?></label>
                <select name="difficulty">
                    <option value=""><?= lang('DiveSite.select_difficulty') ?></option>
                    <option value="beginner"><?= lang('DiveSite.beginner') ?></option>
                    <option value="intermediate"><?= lang('DiveSite.intermediate') ?></option>
                    <option value="advanced"><?= lang('DiveSite.advanced') ?></option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Admin.save_site') ?></button>
            <a href="/admin/sites" class="btn btn-ghost btn-block" style="margin-top:0.75rem;"><?= lang('User.cancel') ?></a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
