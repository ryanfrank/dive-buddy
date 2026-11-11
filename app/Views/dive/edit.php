<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:700px; margin:0 auto;">
        <h1><?= lang('Dive.edit_dive') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= implode('<br>', array_map('esc', $errors)) ?></div>
        <?php endif; ?>

        <form action="/dives/<?= $dive['id'] ?>/update" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('Dive.dive_site') ?></label>
                <select name="dive_site_id">
                    <option value=""><?= lang('Dive.select_site') ?></option>
                    <?php foreach ($sites as $site): ?>
                        <option value="<?= $site['id'] ?>" <?= old('dive_site_id', $dive['dive_site_id'] ?? '') == $site['id'] ? 'selected' : '' ?>>
                            <?= esc($site['name']) ?> — <?= esc($site['location']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label><?= lang('Dive.dive_date') ?></label>
                <input type="date" name="dive_date" value="<?= old('dive_date', $dive['dive_date'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('Dive.max_depth') ?></label>
                <input type="number" name="max_depth" step="0.1" value="<?= old('max_depth', $dive['max_depth'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.bottom_time') ?></label>
                <input type="number" name="bottom_time" value="<?= old('bottom_time', $dive['bottom_time'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.visibility') ?></label>
                <input type="number" name="visibility" step="0.1" value="<?= old('visibility', $dive['visibility'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.conditions') ?></label>
                <input type="text" name="conditions" value="<?= old('conditions', $dive['conditions'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.notes') ?></label>
                <textarea name="notes" rows="4"><?= old('notes', $dive['notes'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_public" value="1" <?= old('is_public', $dive['is_public'] ?? '') ? 'checked' : '' ?>>
                    <?= lang('Dive.make_public') ?>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Dive.save_changes') ?></button>
            <a href="/user/dives" class="btn btn-ghost btn-block" style="margin-top:0.75rem;"><?= lang('User.cancel') ?></a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
