<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:600px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('Rating.rating_details') ?></span>
        </div>
        <div class="card-body">
            <p><strong><?= lang('Rating.rated_user') ?>:</strong> <?= esc($rating['rated_name'] ?? 'Unknown') ?></p>
            <p><strong><?= lang('Rating.rated_by') ?>:</strong> <?= esc($rating['rater_name'] ?? 'Anonymous') ?></p>
            <p><strong><?= lang('Rating.rating') ?>:</strong> <span class="rating-badge"><?= esc($rating['rating']) ?> ★</span></p>
            <?php if ($rating['comment']): ?>
                <p><strong><?= lang('Rating.comment') ?>:</strong> <?= esc($rating['comment']) ?></p>
            <?php endif; ?>
            <p><strong><?= lang('Rating.created_at') ?>:</strong> <?= esc($rating['created_at'] ?? '') ?></p>
            <a href="/dives/<?= $rating['dive_id'] ?>" class="btn btn-primary"><?= lang('Dive.back_to_dive') ?></a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
