<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($task) && $task ? 'Edit Task' : 'Add Task' ?> | Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="container">
    <h1><?= isset($task) && $task ? 'Edit Task' : 'Add New Task' ?></h1>

    <?php if (isset($validation) && $validation): ?>
        <div class="error">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <?php
        $editing = isset($task) && $task;
        $action = $editing
            ? site_url('tasks/update/' . $task['id'])
            : site_url('tasks');
    ?>

    <form action="<?= $action ?>" method="post">
        <?= csrf_field() ?>

        <label for="title">Task Title *</label>
        <input
            type="text"
            id="title"
            name="title"
            maxlength="255"
            value="<?= esc(old('title', $task['title'] ?? '')) ?>"
            required
        >

        <label for="description">Description</label>
        <textarea
            id="description"
            name="description"
            rows="4"
        ><?= esc(old('description', $task['description'] ?? '')) ?></textarea>

        <label for="task_date">Task Date *</label>
        <input
            type="date"
            id="task_date"
            name="task_date"
            value="<?= esc(old('task_date', $task['task_date'] ?? '')) ?>"
            required
        >

        <button type="submit">
            <?= $editing ? 'Save Changes' : 'Add Task' ?>
        </button>

        <a href="<?= site_url('tasks') ?>">Cancel</a>
    </form>
</div>

</body>
</html>