<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="card" style="max-width:900px; margin:0 auto;">
        <div class="card-header">
            <span class="card-title"><?= lang('Admin.dashboard') ?></span>
        </div>
        <div class="card-body" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:1rem;">
            <div class="card" style="padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; font-weight:700; color:var(--color-primary);"><?= $userCount ?? 0 ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('Admin.total_users') ?></div>
            </div>
            <div class="card" style="padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; font-weight:700; color:var(--color-primary);"><?= $diveCount ?? 0 ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('Admin.total_dives') ?></div>
            </div>
            <div class="card" style="padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; font-weight:700; color:var(--color-primary);"><?= $siteCount ?? 0 ?></div>
                <div style="font-size:0.85rem; color:var(--color-text-muted);"><?= lang('Admin.total_sites') ?></div>
            </div>
        </div>
    </div>

    <div class="card" style="max-width:900px; margin:2rem auto 0;">
        <div class="card-header">
            <span class="card-title"><?= lang('Admin.recent_users') ?></span>
        </div>
        <div class="card-body">
            <?php if (empty($recentUsers)): ?>
                <p><?= lang('Admin.no_users') ?></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= lang('User.name') ?></th>
                            <th><?= lang('User.email') ?></th>
                            <th><?= lang('User.role') ?></th>
                            <th><?= lang('User.joined') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentUsers as $u): ?>
                            <tr>
                                <td><?= esc($u['name']) ?></td>
                                <td><?= esc($u['email']) ?></td>
                                <td>
                                    <span class="badge <?= $u['is_admin'] ? 'bg-success' : 'bg-muted' ?>">
                                        <?= $u['is_admin'] ? lang('User.admin') : lang('User.user') ?>
                                    </span>
                                </td>
                                <td><?= esc($u['created_at'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
