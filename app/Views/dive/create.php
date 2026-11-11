<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:700px; margin:0 auto;">
        <h1><?= lang('Dive.log_dive') ?></h1>
        <?php if (isset($errors)): ?>
            <div class="alert alert-error"><?= implode('<br>', array_map('esc', $errors)) ?></div>
        <?php endif; ?>

        <form action="/dives/log" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('Dive.dive_site') ?></label>
                <select name="dive_site_id">
                    <option value=""><?= lang('Dive.select_site') ?></option>
                    <?php foreach ($sites as $site): ?>
                        <option value="<?= $site['id'] ?>"><?= esc($site['name']) ?> — <?= esc($site['location']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label><?= lang('Dive.dive_date') ?></label>
                <input type="date" name="dive_date" value="<?= old('dive_date', date('Y-m-d')) ?>" required>
            </div>
            <div class="form-group">
                <label><?= lang('Dive.max_depth') ?></label>
                <input type="number" name="max_depth" step="0.1" value="<?= old('max_depth') ?>" placeholder="meters">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.bottom_time') ?></label>
                <input type="number" name="bottom_time" value="<?= old('bottom_time') ?>" placeholder="minutes">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.visibility') ?></label>
                <input type="number" name="visibility" step="0.1" value="<?= old('visibility') ?>" placeholder="meters">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.conditions') ?></label>
                <input type="text" name="conditions" value="<?= old('conditions') ?>" placeholder="e.g. calm, clear">
            </div>
            <div class="form-group">
                <label><?= lang('Dive.notes') ?></label>
                <textarea name="notes" rows="4"><?= old('notes') ?></textarea>
            </div>
            <div class="form-group">
                <label style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_public" value="1" <?= old('is_public') ? 'checked' : '' ?>>
                    <?= lang('Dive.make_public') ?>
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Dive.save_dive') ?></button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
