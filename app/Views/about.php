<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> BEHIND THE PROJECT</p>
        <h1>About this space<span class="accent">.</span></h1>
        <p class="lead">A small tool built to keep the day's work in focus.</p>
    </div>
</section>

<section class="about-grid">
    <div class="panel about-main">
        <span class="about-symbol" aria-hidden="true">✦</span>
        <p class="section-kicker">WHAT IT DOES</p>
        <h2>Less clutter. More clarity.</h2>
        <p>Tasks for Today is a simple task management dashboard. The home page shows only tasks due today; the complete list lets you see work across every date. A demo profile gives the workspace a human touch.</p>
        <p>Built with CodeIgniter 4, PHP, and MySQL for the IT0049 Web System Technologies assessment.</p>
    </div>
    <div class="panel developer-card">
        <p class="section-kicker">THE DEVELOPER</p>
        <span class="developer-avatar" aria-hidden="true">✳</span>
        <h2><?= esc($developer) ?></h2>
        <p>Developer of the Tasks for Today Management System</p>
        <div class="developer-tag">IT0049 · TECHNICAL SUMMATIVE ASSESSMENT</div>
    </div>
</section>
<?= $this->endSection() ?>
