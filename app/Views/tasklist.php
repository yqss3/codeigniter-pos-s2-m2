<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List | Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="container">
    <h1>Tasks for Today</h1>
    <p>Welcome, <?= esc(session()->get('user_name')) ?>!</p>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a> |
        <a href="<?= site_url('profile') ?>">Profile</a> |
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="success"><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <p class="error"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>

    <p>
        <a href="<?= site_url('tasks/new') ?>">+ Add New Task</a>
    </p>

    <?php if (empty($tasks)): ?>
        <p>No active tasks found. Add a new task to get started!</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= esc($task['title']) ?></td>
                        <td><?= esc($task['description'] ?? '') ?></td>
                        <td><?= esc($task['task_date']) ?></td>
                        <td>
                            <a href="<?= site_url('tasks/edit/' . $task['id']) ?>">
                                Edit
                            </a>

                            <form
                                action="<?= site_url('tasks/archive/' . $task['id']) ?>"
                                method="post"
                                style="display:inline"
                                onsubmit="return confirm('Archive this task?');"
                            >
                                <?= csrf_field() ?>
                                <button type="submit">Archive</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <form action="<?= site_url('logout') ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>