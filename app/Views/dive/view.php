<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:800px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('Dive.dive_details') ?></span>
        </div>
        <div class="card-body">
            <div style="display:grid; grid-template-columns: 2fr 1fr; gap:1.5rem;">
                <div>
                    <h2><?= esc($dive['dive_date']) ?></h2>
                    <p><strong><?= lang('Dive.site') ?>:</strong> <?= esc($dive['site_name'] ?? lang('Dive.unknown_site')) ?></p>
                    <p><strong><?= lang('Dive.logged_by') ?>:</strong> <?= esc($dive['user_name']) ?></p>
                    <?php if ($dive['max_depth']): ?>
                        <p><strong><?= lang('Dive.max_depth') ?>:</strong> <?= esc($dive['max_depth']) ?> m</p>
                    <?php endif; ?>
                    <?php if ($dive['bottom_time']): ?>
                        <p><strong><?= lang('Dive.bottom_time') ?>:</strong> <?= esc($dive['bottom_time']) ?> min</p>
                    <?php endif; ?>
                    <?php if ($dive['visibility']): ?>
                        <p><strong><?= lang('Dive.visibility') ?>:</strong> <?= esc($dive['visibility']) ?> m</p>
                    <?php endif; ?>
                    <?php if ($dive['conditions']): ?>
                        <p><strong><?= lang('Dive.conditions') ?>:</strong> <?= esc($dive['conditions']) ?></p>
                    <?php endif; ?>
                    <?php if ($dive['notes']): ?>
                        <p><strong><?= lang('Dive.notes') ?>:</strong> <?= esc($dive['notes']) ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if (session('is_logged_in') && session('user_id') == $dive['user_id']): ?>
                        <a href="/dives/<?= $dive['id'] ?>/edit" class="btn btn-ghost btn-block"><?= lang('Dive.edit') ?></a>
                        <form action="/dives/<?= $dive['id'] ?>/delete" method="post" style="margin-top:0.5rem;" onsubmit="return confirm('<?= lang('Dive.confirm_delete') ?>');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-ghost btn-block" style="color:var(--color-danger);"><?= lang('Dive.delete') ?></button>
                        </form>
                    <?php elseif (session('is_logged_in')): ?>
                        <a href="/user/partners/connect/<?= $dive['id'] ?>" class="btn btn-primary btn-block"><?= lang('Dive.join_dive') ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($participants)): ?>
        <div class="card" style="max-width:800px; margin:2rem auto 0;">
            <div class="card-header">
                <span class="card-title"><?= lang('Dive.participants') ?></span>
            </div>
            <div class="card-body">
                <div class="grid">
                    <?php foreach ($participants as $p): ?>
                        <div class="card" style="padding:1rem;">
                            <div class="card-body">
                                <h4 style="margin:0 0 0.25rem;"><?= esc($p['user_name']) ?></h4>
                                <p style="color:var(--color-text-muted); font-size:0.9rem; margin:0;"><?= esc($p['certification_level'] ?? '') ?></p>
                                <?php if (session('is_logged_in') && $p['user_id'] != session('user_id') && !$p['rated']): ?>
                                    <div style="margin-top:0.75rem;">
                                        <a href="/rating/create/<?= $dive['id'] ?>" class="btn btn-sm btn-primary"><?= lang('Dive.rate_partner') ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($ratings)): ?>
        <div class="card" style="max-width:800px; margin:2rem auto 0;">
            <div class="card-header">
                <span class="card-title"><?= lang('Dive.partner_ratings') ?></span>
            </div>
            <div class="card-body">
                <?php foreach ($ratings as $r): ?>
                    <div style="padding:1rem 0; border-bottom:1px solid var(--color-border);">
                        <strong><?= esc($r['rater_name'] ?? 'Anonymous') ?></strong> rated
                        <span class="rating-badge"><?= esc($r['rating']) ?> <?= lang('Dive.stars') ?></span>
                        <?php if ($r['comment']): ?>
                            <p style="margin:0.25rem 0 0;"><?= esc($r['comment']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
