<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:800px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('Dive.recent_dives') ?></span>
        </div>
        <?php if (empty($dives)): ?>
            <div class="card-body" style="text-align:center; padding:2rem;">
                <p><?= lang('Dive.no_dives_yet') ?></p>
            </div>
        <?php else: ?>
            <div class="card-body">
                <div class="grid">
                    <?php foreach ($dives as $dive): ?>
                        <div class="card" style="padding:1rem;">
                            <div class="card-body">
                                <h4 style="margin:0 0 0.25rem;"><?= esc($dive['dive_date']) ?></h4>
                                <p style="color:var(--color-text-muted); font-size:0.9rem;"><?= esc($dive['notes'] ?? '') ?></p>
                                <div style="margin-top:0.75rem;">
                                    <a href="/dives/<?= $dive['id'] ?>" class="btn btn-sm btn-primary"><?= lang('Dive.view') ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
