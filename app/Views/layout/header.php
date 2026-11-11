<!DOCTYPE html>
<html lang="<?= esc($locale ?? service('request')->getLocale()) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Dive Buddy') ?> | Dive Buddy</title>
    <meta name="description" content="<?= esc($siteDescription ?? 'Connect with divers worldwide. Log dives, find partners, rate experiences.') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <?php if (isset($extraStyles)): ?>
        <?= $extraStyles ?>
    <?php endif; ?>
</head>
<body class="<?= esc($bodyClass ?? '') ?>">
    <?php echo view('layout/navbar', $navbarData ?? []); ?>

    <main>
        <?php if (session('success')): ?>
            <div class="alert alert-success"><?= esc(session('success')) ?></div>
        <?php endif; ?>
        <?php if (session('error')): ?>
            <div class="alert alert-error"><?= esc(session('error')) ?></div>
        <?php endif; ?>
        <?php if (session('warning')): ?>
            <div class="alert alert-warning"><?= esc(session('warning')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <?php echo view('layout/footer'); ?>

    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>
