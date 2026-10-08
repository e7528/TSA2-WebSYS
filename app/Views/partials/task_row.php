<article class="task-row">
    <span class="task-indicator <?= $task['status'] === 'completed' ? 'task-indicator--done' : '' ?>" aria-hidden="true"><?= $task['status'] === 'completed' ? '✓' : '' ?></span>
    <div class="task-details">
        <h3><?= esc($task['title']) ?></h3>
        <span class="task-subline">Task #<?= esc($task['id']) ?><?= $showDate ? ' · ' . esc(date('M j, Y', strtotime($task['task_date']))) : '' ?></span>
    </div>
    <span class="status status--<?= esc($task['status'], 'attr') ?>"><?= esc(ucwords(str_replace('_', ' ', $task['status']))) ?></span>
    <?php if (session()->has('user_id')): ?>
        <div class="task-actions">
            <a href="<?= site_url('tasks/' . $task['id'] . '/edit') ?>" aria-label="Edit <?= esc($task['title'], 'attr') ?>">Edit</a>
            <form method="post" action="<?= site_url('tasks/' . $task['id'] . '/archive') ?>" onsubmit="return confirm('Archive this task?')">
                <?= csrf_field() ?><button type="submit" aria-label="Archive <?= esc($task['title'], 'attr') ?>">Archive</button>
            </form>
        </div>
    <?php endif ?>
</article>
