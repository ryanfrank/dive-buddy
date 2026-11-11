<nav class="top-nav">
    <div class="container nav-inner">
        <div class="nav-brand">
            <a href="/" style="text-decoration:none; color:inherit;">
                <span class="brand-icon">🤿</span>
                <span class="brand-name">Dive<span class="brand-buddy">Buddy</span></span>
            </a>
        </div>

        <div class="nav-menu">
            <a href="/" class="<?= uri_string() === '/' ? 'active' : '' ?>"><?= lang('Home.home') ?></a>
            <a href="/dive-sites"><?= lang('DiveSite.dive_sites') ?></a>
            <a href="/dives"><?= lang('Dive.recent_dives') ?></a>
            <?php if (session('is_logged_in')): ?>
                <a href="/user/profile"><?= lang('User.profile') ?></a>
                <a href="/dives/log"><?= lang('Dive.log_dive') ?></a>
                <a href="/user/partners"><?= lang('DivePartner.find_partners') ?></a>
                <?php if (session('is_admin')): ?>
                    <a href="/admin"><?= lang('Admin.dashboard') ?></a>
                <?php endif; ?>
                <a href="/auth/logout"><?= lang('Auth.logout') ?></a>
            <?php else: ?>
                <a href="/login"><?= lang('Auth.login') ?></a>
                <a href="/register"><?= lang('Auth.register') ?></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
