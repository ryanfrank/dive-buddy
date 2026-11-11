<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:900px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('Admin.manage_users') ?></span>
        </div>
        <div class="card-body">
            <?php if (empty($users)): ?>
                <p><?= lang('Admin.no_users') ?></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= lang('User.name') ?></th>
                            <th><?= lang('User.email') ?></th>
                            <th><?= lang('User.role') ?></th>
                            <th><?= lang('Admin.actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= esc($u['name']) ?></td>
                                <td><?= esc($u['email']) ?></td>
                                <td>
                                    <span class="badge <?= $u['is_admin'] ? 'bg-success' : 'bg-muted' ?>">
                                        <?= $u['is_admin'] ? lang('User.admin') : lang('User.user') ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!$u['is_admin']): ?>
                                        <a href="/admin/users/<?= $u['id'] ?>/toggle-admin" class="btn btn-sm btn-ghost" onclick="return confirm('<?= lang('Admin.confirm_promote', ['name' => esc($u['name'])]) ?>');">
                                            <?= lang('Admin.make_admin') ?>
                                        </a>
                                    <?php else: ?>
                                        <a href="/admin/users/<?= $u['id'] ?>/toggle-admin" class="btn btn-sm btn-ghost" style="color:var(--color-danger);" onclick="return confirm('<?= lang('Admin.confirm_demote', ['name' => esc($u['name'])]) ?>');">
                                            <?= lang('Admin.remove_admin') ?>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
