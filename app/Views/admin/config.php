<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container" style="max-width:600px; margin:0 auto;">
        <h1><?= lang('Admin.site_config') ?></h1>
        <p><?= lang('Admin.config_desc') ?></p>
        <form action="/admin/config/update" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label><?= lang('Admin.site_name') ?></label>
                <input type="text" name="site_name" value="Dive Buddy">
            </div>
            <div class="form-group">
                <label><?= lang('Admin.site_email') ?></label>
                <input type="email" name="site_email" value="admin@divebuddy.com">
            </div>
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Admin.save_config') ?></button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
