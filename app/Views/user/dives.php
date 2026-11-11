<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <span class="card-title"><?= lang('User.my_dives') ?></span>
            <a href="/dives/log" class="btn btn-primary btn-sm"><?= lang('Dive.log_dive') ?></a>
        </div>
        <?php if (empty($dives)): ?>
            <div class="card-body" style="text-align:center; padding:2rem;">
                <p><?= lang('User.no_dives_yet') ?></p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th><?= lang('Dive.date') ?></th>
                        <th><?= lang('Dive.site') ?></th>
                        <th><?= lang('Dive.depth') ?></th>
                        <th><?= lang('Dive.time') ?></th>
                        <th><?= lang('Dive.actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dives as $dive): ?>
                        <tr>
                            <td><?= esc($dive['dive_date']) ?></td>
                            <td><?= esc($dive['site_name'] ?? lang('Dive.unknown_site')) ?></td>
                            <td><?= $dive['max_depth'] ? esc($dive['max_depth'] . ' m') : '—' ?></td>
                            <td><?= $dive['bottom_time'] ? esc($dive['bottom_time'] . ' min') : '—' ?></td>
                            <td>
                                <a href="/dives/<?= $dive['id'] ?>" class="btn btn-sm btn-ghost"><?= lang('Dive.view') ?></a>
                                <a href="/dives/<?= $dive['id'] ?>/edit" class="btn btn-sm btn-ghost"><?= lang('Dive.edit') ?></a>
                                <form action="/dives/<?= $dive['id'] ?>/delete" method="post" style="display:inline;" onsubmit="return confirm('<?= lang('Dive.confirm_delete') ?>');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-ghost" style="color:var(--color-danger);"><?= lang('Dive.delete') ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
