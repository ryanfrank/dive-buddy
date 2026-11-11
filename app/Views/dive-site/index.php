<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
            <span class="card-title"><?= lang('DiveSite.dive_sites') ?></span>
            <?php if ($query): ?>
                <a href="/dive-sites" class="btn btn-sm btn-ghost"><?= lang('DiveSite.clear_search') ?></a>
            <?php endif; ?>
        </div>
        <?php if ($query): ?>
            <div class="alert alert-info"><?= lang('DiveSite.search_results', ['query' => esc($query)]) ?></div>
        <?php endif; ?>

        <?php if (empty($sites)): ?>
            <div class="card-body" style="text-align:center; padding:2rem;">
                <p><?= lang('DiveSite.no_sites') ?></p>
            </div>
        <?php else: ?>
            <div class="card-body">
                <div class="grid">
                    <?php foreach ($sites as $site): ?>
                        <div class="card" style="padding:1rem;">
                            <div class="card-body">
                                <h4 style="margin:0 0 0.25rem;"><?= esc($site['name']) ?></h4>
                                <p style="color:var(--color-text-muted); font-size:0.9rem; margin:0;">
                                    <?= esc($site['location'] . ', ' . $site['country']) ?>
                                </p>
                                <?php if ($site['difficulty']): ?>
                                    <div style="margin-top:0.5rem;">
                                        <span class="badge bg-muted"><?= lang('DiveSite.difficulty') ?>: <?= esc($site['difficulty']) ?></span>
                                    </div>
                                <?php endif; ?>
                                <div style="margin-top:0.75rem;">
                                    <a href="/dive-sites/<?= $site['id'] ?>" class="btn btn-sm btn-primary"><?= lang('DiveSite.view_site') ?></a>
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
