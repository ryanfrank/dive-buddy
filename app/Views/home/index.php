<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<section class="hero">
    <div class="container">
        <h1><?= lang('Home.hero_title') ?></h1>
        <p><?= lang('Home.hero_subtitle') ?></p>
        <div class="hero-actions">
            <?php if (!session('is_logged_in')): ?>
                <a href="/register" class="btn btn-primary btn-lg"><?= lang('Home.join_free') ?></a>
                <a href="/login" class="btn btn-ghost btn-lg"><?= lang('Home.sign_in') ?></a>
            <?php else: ?>
                <a href="/dives/log" class="btn btn-primary btn-lg"><?= lang('Home.log_dive') ?></a>
                <a href="/dive-sites" class="btn btn-ghost btn-lg"><?= lang('Home.explore_sites') ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="container">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><?= lang('Home.recent_dives') ?></span>
            <a href="/dives" class="btn btn-sm btn-ghost"><?= lang('Home.view_all') ?></a>
        </div>
        <div class="grid">
            <?php foreach ($recentDives as $dive): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="badge bg-primary"><?= esc($dive['conditions'] ?? lang('Dive.no_conditions')) ?></div>
                        <h4 style="margin:0.5rem 0 0.25rem;"><?= esc($dive['dive_date']) ?></h4>
                        <p style="color:var(--color-text-muted); font-size:0.9rem;"><?= esc($dive['notes'] ?? '') ?></p>
                        <div style="margin-top:0.75rem; font-size:0.85rem; color:var(--color-text-muted);">
                            <?= lang('Dive.by') ?> <?= esc($dive['user_name'] ?? 'Anonymous') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div class="card">
    <div class="card-header">
        <span class="card-title"><?= lang('DiveSite.featured_sites') ?></span>
    </div>
    <div class="grid">
        <?php foreach ($diveSites as $site): ?>
            <div class="card">
                <div class="card-body">
                    <h4 style="margin:0 0 0.25rem;"><?= esc($site['name']) ?></h4>
                    <p style="color:var(--color-text-muted); font-size:0.9rem;"><?= esc($site['location'] . ', ' . $site['country']) ?></p>
                    <div style="margin-top:0.75rem;">
                        <a href="/dive-sites/<?= $site['id'] ?>" class="btn btn-sm btn-primary"><?= lang('DiveSite.view_site') ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
