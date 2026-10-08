<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<section class="page-intro">
    <div>
        <p class="eyebrow"><span class="eyebrow-dot" aria-hidden="true"></span> YOUR DAILY OVERVIEW</p>
        <h1>Make today count<span class="accent">.</span></h1>
        <p class="lead">A clear view of what needs your attention, right now.</p>
    </div>
    <span class="date-pill"><span aria-hidden="true">▦</span> <?= esc(date('l, F j, Y', strtotime($today))) ?></span>
</section>

<section class="metric-grid" aria-label="Today's task summary">
    <div class="metric metric--all"><span class="metric-label">TASKS TODAY</span><strong><?= count($tasks) ?></strong><span class="metric-foot">On your daily list</span><span class="metric-icon" aria-hidden="true">◫</span></div>
    <div class="metric metric--progress"><span class="metric-label">IN PROGRESS</span><strong><?= count($tasks) - $completed - $pending ?></strong><span class="metric-foot">Currently moving</span><span class="metric-icon" aria-hidden="true">↗</span></div>
    <div class="metric metric--done"><span class="metric-label">COMPLETED</span><strong><?= $completed ?></strong><span class="metric-foot">Checked off today</span><span class="metric-icon" aria-hidden="true">✓</span></div>
</section>

<section class="panel" aria-labelledby="today-heading">
    <div class="panel-header">
        <div><p class="section-kicker">FOCUS LIST</p><h2 id="today-heading">Today's tasks <span class="count"><?= count($tasks) ?></span></h2></div>
        <a class="text-link" href="<?= site_url('tasks') ?>">View all tasks <span aria-hidden="true">→</span></a>
    </div>
    <?php if ($tasks === []): ?>
        <p class="empty-state">No tasks are scheduled for today. Your day is clear.</p>
    <?php else: ?>
        <div class="task-list">
            <?php foreach ($tasks as $task): ?>
                <?= view('partials/task_row', ['task' => $task, 'showDate' => false]) ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>

<p class="page-hint"><span aria-hidden="true">✦</span> Showing tasks scheduled for today only.</p>
<?= $this->endSection() ?>
