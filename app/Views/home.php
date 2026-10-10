<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="container">
    <h1>Tasks for Today Management System</h1>
    <p>Organize your tasks and manage your daily activities.</p>

    <nav>
        <a href="<?= site_url('/') ?>">Home</a> |
        <a href="<?= site_url('about') ?>">About</a>

        <?php if (session()->get('logged_in')): ?>
            | <a href="<?= site_url('tasks') ?>">Task List</a>
            | <a href="<?= site_url('profile') ?>">Profile</a>
        <?php else: ?>
            | <a href="<?= site_url('login') ?>">Login</a>
        <?php endif; ?>
    </nav>

    <?php if (session()->get('logged_in')): ?>
        <h2>Hello, <?= esc(session()->get('user_name')) ?>!</h2>
        <h3>Today's Tasks — <?= esc($today) ?></h3>

        <?php if (empty($tasks)): ?>
            <p>You have no active tasks scheduled for today.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <strong><?= esc($task['title']) ?></strong>
                        — <?= esc($task['description'] ?? '') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <p><a href="<?= site_url('tasks') ?>">Manage All Tasks</a></p>
        <p><a href="<?= site_url('tasks/new') ?>">Add a Task</a></p>
    <?php else: ?>
        <h2>Welcome!</h2>
        <p>Please log in to manage your tasks.</p>
        <a href="<?= site_url('login') ?>">Login to Get Started</a>
    <?php endif; ?>

</div>

</body>
</html>