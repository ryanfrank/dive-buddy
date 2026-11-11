<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:700px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('User.profile') ?></span>
            <?php if ($user['is_admin']): ?>
                <span class="badge bg-success"><?= lang('User.admin') ?></span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <h2 style="margin-bottom:0.5rem;"><?= esc($user['name']) ?></h2>
            <p style="color:var(--color-text-muted);"><?= esc($user['email']) ?></p>
            <?php if ($user['location']): ?>
                <p><strong><?= lang('User.location') ?>:</strong> <?= esc($user['location']) ?></p>
            <?php endif; ?>
            <?php if ($user['certification_level']): ?>
                <p><strong><?= lang('User.certification_level') ?>:</strong> <?= esc($user['certification_level']) ?></p>
            <?php endif; ?>
            <?php if ($user['bio']): ?>
                <p><strong><?= lang('User.bio') ?>:</strong> <?= esc($user['bio']) ?></p>
            <?php endif; ?>
            <div style="margin-top:1.5rem;">
                <a href="/user/profile/edit" class="btn btn-ghost"><?= lang('User.edit_profile') ?></a>
            </div>
        </div>
    </div>

    <div class="card" style="max-width:700px; margin:2rem auto 0;">
        <div class="card-header">
            <span class="card-title"><?= lang('User.dive_stats') ?></span>
        </div>
        <div class="card-body" style="display:flex; gap:2rem; flex-wrap:wrap;">
            <div style="text-align:center; flex:1; min-width:120px;">
                <div style="font-size:1.5rem; font-weight:700; color:var(--color-primary);"><?= $stats['total_dives'] ?? 0 ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('User.total_dives') ?></div>
            </div>
            <div style="text-align:center; flex:1; min-width:120px;">
                <div style="font-size:1.5rem; font-weight:700; color:var(--color-primary);"><?= $stats['sites_visited'] ?? 0 ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('User.sites_visited') ?></div>
            </div>
            <div style="text-align:center; flex:1; min-width:120px;">
                <div style="font-size:1.5rem; font-weight:700; color:var(--color-primary);"><?= $stats['avg_rating'] ?? '-' ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('User.avg_rating') ?></div>
            </div>
        </div>
    </div>

    <?php if (!empty($recentDives)): ?>
        <div class="card" style="max-width:700px; margin:2rem auto 0;">
            <div class="card-header">
                <span class="card-title"><?= lang('User.recent_dives') ?></span>
            </div>
            <div class="card-body">
                <div class="grid">
                    <?php foreach ($recentDives as $dive): ?>
                        <div class="card" style="padding:1rem;">
                            <div class="card-body">
                                <h4 style="margin:0 0 0.25rem;"><?= esc($dive['dive_date']) ?></h4>
                                <p style="color:var(--color-text-muted); font-size:0.9rem; margin:0;"><?= esc($dive['notes'] ?? '') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
