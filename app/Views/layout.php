<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title><?= esc($pageTitle) ?> · Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar" aria-label="Application navigation">
        <a class="brand" href="<?= site_url('/') ?>" aria-label="Tasks for Today home">
            <span class="brand-mark" aria-hidden="true">✓</span>
            <span class="brand-label">TASKS<span>FOR TODAY</span></span>
        </a>

        <div class="sidebar-group">
            <div class="nav-caption">WORKSPACE</div>
            <nav class="nav" aria-label="Main">
                <a class="nav-link <?= $activePage === 'today' ? 'is-active' : '' ?>" href="<?= site_url('/') ?>" <?= $activePage === 'today' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">◫</span> Today</a>
                <a class="nav-link <?= $activePage === 'tasks' ? 'is-active' : '' ?>" href="<?= site_url('tasks') ?>" <?= $activePage === 'tasks' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">☷</span> All tasks</a>
                <a class="nav-link <?= $activePage === 'profile' ? 'is-active' : '' ?>" href="<?= site_url('profile') ?>" <?= $activePage === 'profile' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">◯</span> Profile</a>
                <a class="nav-link <?= $activePage === 'about' ? 'is-active' : '' ?>" href="<?= site_url('about') ?>" <?= $activePage === 'about' ? 'aria-current="page"' : '' ?>><span aria-hidden="true">ⓘ</span> About</a>
            </nav>
        </div>

        <div class="sidebar-note">
            <span class="sidebar-note-icon" aria-hidden="true">✦</span>
            <strong>One day at a time.</strong>
            <p>A little focus makes a lot of progress.</p>
        </div>
    </aside>

    <main class="main" id="content">
        <header class="topbar">
            <span class="topbar-label">MY WORKSPACE <span aria-hidden="true">/</span> <?= esc(strtoupper($pageTitle)) ?></span>
            <div class="account-area">
                <?php if (session()->has('user_id')): ?>
                    <span class="topbar-person"><?= esc(session('display_name')) ?></span>
                    <form method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="topbar-action" type="submit">Sign out</button></form>
                <?php else: ?>
                    <a class="topbar-action" href="<?= site_url('login') ?>">Sign in</a>
                <?php endif ?>
            </div>
        </header>

        <div class="content">
            <?php if (session()->getFlashdata('notice')): ?><p class="notice" role="status"><?= esc(session()->getFlashdata('notice')) ?></p><?php endif ?>
            <?= $this->renderSection('content') ?>
            <footer class="footer">Tasks for Today <span aria-hidden="true">·</span> A calmer way to see your day</footer>
        </div>
    </main>
</div>
</body>
</html>
