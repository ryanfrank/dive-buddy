<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:800px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('DivePartner.find_partners') ?></span>
        </div>
        <div class="card-body">
            <p><?= lang('DivePartner.find_desc') ?></p>

            <?php if ($user['location']): ?>
                <h3><?= lang('DivePartner.nearby_divers') ?></h3>
                <?php if (empty($potential)): ?>
                    <p><?= lang('DivePartner.no_nearby') ?></p>
                <?php else: ?>
                    <div class="grid">
                        <?php foreach ($potential as $p): ?>
                            <div class="card" style="padding:1rem;">
                                <div class="card-body">
                                    <h4 style="margin:0 0 0.25rem;"><?= esc($p['name']) ?></h4>
                                    <p style="color:var(--color-text-muted); font-size:0.9rem; margin:0;">
                                        <?= esc($p['certification_level'] ?? '') ?>
                                    </p>
                                    <div style="margin-top:0.75rem;">
                                        <a href="/user/profile" class="btn btn-sm btn-primary"><?= lang('DivePartner.view_profile') ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-warning">
                    <?= lang('DivePartner.set_location') ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($history)): ?>
                <h3 style="margin-top:2rem;"><?= lang('DivePartner.your_dive_history') ?></h3>
                <div class="grid">
                    <?php foreach ($history as $h): ?>
                        <div class="card" style="padding:1rem;">
                            <div class="card-body">
                                <h4 style="margin:0 0 0.25rem;"><?= esc($h['dive_date']) ?></h4>
                                <p style="color:var(--color-text-muted); font-size:0.9rem; margin:0;">
                                    <?= esc($h['site_name'] ?? lang('Dive.unknown_site')) ?>
                                </p>
                                <div style="margin-top:0.75rem;">
                                    <a href="/dives/<?= $h['id'] ?>" class="btn btn-sm btn-primary"><?= lang('Dive.view') ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
