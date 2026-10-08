<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> MEET THE TEAM</p>
        <h1>Profile<span class="accent">.</span></h1>
        <p class="lead">A little more about the person behind the tasks.</p>
    </div>
</section>

<?php if ($user === null): ?>
    <section class="panel"><p class="empty-state">No demo user found. Run the demo seeder to create the profile.</p></section>
<?php else: ?>
    <section class="profile-card" aria-labelledby="profile-name">
        <div class="profile-cover"><span>MEMBER PROFILE</span><span aria-hidden="true">✳</span></div>
        <div class="profile-body">
            <div class="avatar" aria-hidden="true">AR</div>
            <p class="section-kicker">DEMO MEMBER</p>
            <h2 id="profile-name"><?= esc($user['full_name']) ?></h2>
            <p class="profile-username">@<?= esc($user['username']) ?></p>
            <dl class="profile-facts">
                <div><dt>EMAIL ADDRESS</dt><dd><a href="mailto:<?= esc($user['email'], 'attr') ?>"><?= esc($user['email']) ?></a></dd></div>
                <div><dt>USERNAME</dt><dd><?= esc($user['username']) ?></dd></div>
                <div><dt>MEMBER SINCE</dt><dd><?= esc(date('F j, Y', strtotime($user['created_at']))) ?></dd></div>
            </dl>
        </div>
    </section>
<?php endif ?>
<?= $this->endSection() ?>
