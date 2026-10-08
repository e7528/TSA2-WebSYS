<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> THE FULL PICTURE</p>
        <h1>All your tasks<span class="accent">.</span></h1>
        <p class="lead">Every task in one place, ordered from earliest to latest.</p>
    </div>
    <div class="page-intro-actions">
        <?php if (session()->has('user_id')): ?><a class="primary-button" href="<?= site_url('tasks/new') ?>">+ New task</a><?php endif ?>
        <span class="date-pill"><span aria-hidden="true">☷</span> <?= count($tasks) ?> TASK<?= count($tasks) === 1 ? '' : 'S' ?></span>
    </div>
</section>

<section class="panel" aria-labelledby="all-heading">
    <div class="panel-header">
        <div><p class="section-kicker">COMPLETE LIST</p><h2 id="all-heading">Task directory <span class="count"><?= count($tasks) ?></span></h2></div>
        <a class="text-link" href="<?= site_url('/') ?>">Today's view <span aria-hidden="true">→</span></a>
    </div>
    <?php if ($tasks === []): ?>
        <p class="empty-state">No active tasks yet.</p>
    <?php else: ?>
        <div class="list-heading" aria-hidden="true"><span>TASK</span><span>STATUS</span></div>
        <div class="task-list">
            <?php foreach ($tasks as $task): ?>
                <?= view('partials/task_row', ['task' => $task, 'showDate' => true]) ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>
<?= $this->endSection() ?>
