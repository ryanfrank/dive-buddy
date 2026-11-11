<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>Dive Buddy</h3>
                <p>Connecting divers worldwide. Log your dives, find partners, and share experiences.</p>
            </div>
            <div class="footer-links">
                <a href="/"><?= lang('Home.home') ?></a>
                <a href="/dive-sites"><?= lang('DiveSite.dive_sites') ?></a>
                <a href="/dives"><?= lang('Dive.recent_dives') ?></a>
                <a href="/about"><?= lang('Home.about') ?></a>
            </div>
            <div class="footer-user">
                <?php if (session('is_logged_in')): ?>
                    <a href="/user/profile"><?= lang('User.profile') ?></a>
                    <a href="/auth/logout"><?= lang('Auth.logout') ?></a>
                    <?php if (session('is_admin')): ?>
                        <a href="/admin"><?= lang('Admin.dashboard') ?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="/login"><?= lang('Auth.login') ?></a>
                    <a href="/register"><?= lang('Auth.register') ?></a>
                <?php endif; ?>
            </div>
            <div class="footer-lang">
                <form action="/locale/(:segment)" method="get" style="display:inline;">
                    <select name="lang" onchange="this.form.submit()">
                        <?php foreach (config('App')->supportedLocales as $loc): ?>
                            <option value="<?= esc($loc) ?>" <?= service('request')->getLocale() === $loc ? 'selected' : '' ?>><?= strtoupper($loc) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>
        <p class="footer-copy">&copy; <?= date('Y') ?> Dive Buddy. Built with CodeIgniter 4 & PostgreSQL.</p>
    </div>
</footer>
