<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<section class="page-intro"><div><p class="eyebrow">TASK MANAGEMENT</p><h1><?= esc($pageTitle) ?><span class="accent">.</span></h1><p class="lead">Choose a title, date, and status for this task.</p></div></section>
<section class="panel form-panel" aria-labelledby="task-form-heading">
    <h2 id="task-form-heading"><?= esc($pageTitle) ?></h2>
    <form method="post" action="<?= site_url($mode === 'new' ? 'tasks' : 'tasks/' . $id) ?>">
        <?= csrf_field() ?>
        <label for="title">Title <span aria-hidden="true">*</span></label>
        <input id="title" name="title" type="text" maxlength="150" required value="<?= esc($task['title'], 'attr') ?>" aria-invalid="<?= isset($errors['title']) ? 'true' : 'false' ?>">
        <?php if (isset($errors['title'])): ?><p class="field-error" role="alert"><?= esc($errors['title']) ?></p><?php endif ?>
        <label for="task_date">Task date <span aria-hidden="true">*</span></label>
        <input id="task_date" name="task_date" type="date" required value="<?= esc($task['task_date'], 'attr') ?>" aria-invalid="<?= isset($errors['task_date']) ? 'true' : 'false' ?>">
        <?php if (isset($errors['task_date'])): ?><p class="field-error" role="alert"><?= esc($errors['task_date']) ?></p><?php endif ?>
        <label for="status">Status</label>
        <select id="status" name="status" aria-invalid="<?= isset($errors['status']) ? 'true' : 'false' ?>">
            <?php foreach (['pending' => 'Pending', 'in_progress' => 'In progress', 'completed' => 'Completed'] as $value => $label): ?>
                <option value="<?= esc($value, 'attr') ?>" <?= $task['status'] === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
            <?php endforeach ?>
        </select>
        <?php if (isset($errors['status'])): ?><p class="field-error" role="alert"><?= esc($errors['status']) ?></p><?php endif ?>
        <div class="form-actions"><button class="primary-button" type="submit"><?= $mode === 'new' ? 'Create task' : 'Save changes' ?></button><a class="text-link" href="<?= site_url('tasks') ?>">Cancel</a></div>
    </form>
</section>
<?= $this->endSection() ?>
