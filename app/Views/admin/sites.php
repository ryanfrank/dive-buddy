<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:900px; margin:0 auto;">
        <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
            <span class="card-title"><?= lang('Admin.manage_sites') ?></span>
            <a href="/admin/sites/add" class="btn btn-primary btn-sm"><?= lang('Admin.add_site') ?></a>
        </div>
        <div class="card-body">
            <?php if (empty($sites)): ?>
                <p><?= lang('Admin.no_sites') ?></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= lang('DiveSite.name') ?></th>
                            <th><?= lang('DiveSite.location') ?></th>
                            <th><?= lang('DiveSite.country') ?></th>
                            <th><?= lang('DiveSite.difficulty') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sites as $s): ?>
                            <tr>
                                <td><?= esc($s['name']) ?></td>
                                <td><?= esc($s['location']) ?></td>
                                <td><?= esc($s['country']) ?></td>
                                <td><?= esc($s['difficulty'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
