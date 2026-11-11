<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="form-container">
        <h1><?= lang('Home.about') ?></h1>
        <p><?= lang('Home.about_desc') ?></p>
        <hr style="margin:1.5rem 0; border:none; border-top:1px solid var(--color-border);">
        <h3><?= lang('Home.features') ?></h3>
        <ul style="list-style:disc; margin-left:1.5rem; color:var(--color-text-muted);">
            <li><?= lang('Home.feature_dive_log') ?></li>
            <li><?= lang('Home.feature_find_partners') ?></li>
            <li><?= lang('Home.feature_rate_partners') ?></li>
            <li><?= lang('Home.feature_multilingual') ?></li>
            <li><?= lang('Home.feature_oauth_saml') ?></li>
        </ul>
        <div class="card" style="margin-top:1.5rem;">
            <h4><?= lang('Home.tech_stack') ?></h4>
            <p style="color:var(--color-text-muted);">
                CodeIgniter 4 &bull; PostgreSQL &bull; OAuth2 / SAML &bull; Multilingual (en, es, fr, de)
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
