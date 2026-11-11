<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:800px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= esc($site['name']) ?></span>
            <span class="badge bg-primary"><?= esc($site['country']) ?></span>
        </div>
        <div class="card-body">
            <p><strong><?= lang('DiveSite.location') ?>:</strong> <?= esc($site['location']) ?></p>
            <?php if ($site['description']): ?>
                <p><strong><?= lang('DiveSite.description') ?>:</strong> <?= esc($site['description']) ?></p>
            <?php endif; ?>
            <?php if ($site['difficulty']): ?>
                <p><strong><?= lang('DiveSite.difficulty') ?>:</strong> <?= esc($site['difficulty']) ?></p>
            <?php endif; ?>
            <?php if ($site['total_dives'] !== null): ?>
                <p><strong><?= lang('DiveSite.total_dives') ?>:</strong> <?= $site['total_dives'] ?></p>
            <?php endif; ?>
            <?php if ($site['avg_rating'] !== null): ?>
                <p><strong><?= lang('DiveSite.avg_rating') ?>:</strong> <span class="rating-badge"><?= $site['avg_rating'] ?> ★</span></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
