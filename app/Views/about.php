<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Tasks for Today</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="container">
    <h1>About Tasks for Today</h1>

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

    <h2>Our Purpose</h2>

    <p>
        Tasks for Today is a simple task management system that helps
        users organize their daily activities and keep track of important
        responsibilities.
    </p>

    <h2>Features</h2>

    <ul>
        <li>User login and logout</li>
        <li>Create, view, and edit tasks</li>
        <li>Validate required task information</li>
        <li>Archive tasks without permanently deleting records</li>
        <li>View tasks scheduled for today</li>
    </ul>

    <p>
        This application was developed as part of a CodeIgniter 4
        laboratory activity.
    </p>
</div>

</body>
</html>