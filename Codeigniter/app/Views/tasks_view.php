<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management Dashboard | Task Manager Pro</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 0; background-color: #f4f7f6; color: #333; }
        .navbar { background: #2c3e50; color: white; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; }
        .logout-btn { color: #e74c3c; text-decoration: none; border: 1px solid #e74c3c; padding: 5px 15px; border-radius: 4px; font-weight: bold; transition: 0.3s; }
        .logout-btn:hover { background: #e74c3c; color: white; }
        .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 30px; }
        h2 { font-size: 1.1em; color: #7f8c8d; text-transform: uppercase; margin: 0 0 15px 0; }
        .add-task-form { display: flex; gap: 10px; }
        input { flex: 1; padding: 12px; border: 1px solid #ddd; border-radius: 4px; outline: none; }
        .btn { padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; color: white; transition: 0.2s; }
        .btn-add { background: #27ae60; }
        .task-table { width: 100%; border-collapse: collapse; }
        .task-table td { padding: 15px 12px; border-bottom: 1px solid #eee; }
        .status-badge { font-size: 0.75em; background: #ebf5fb; padding: 4px 12px; border-radius: 15px; color: #2e86c1; font-weight: bold; display: inline-block; }
        .api-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 15px; }
        .api-item { background: #f9f9f9; padding: 15px; border-radius: 6px; border-top: 3px solid #3498db; display: flex; flex-direction: column; justify-content: space-between; }
    </style>
</head>
<body>

<div class="navbar">
    <span><strong>Task Manager Pro</strong></span>
    <span style="font-size: 0.9em;">Administrator: <strong><?= esc(session()->get('username')) ?></strong></span>
    <a href="<?= site_url('logout') ?>" class="logout-btn">Logout</a>
</div>

<div class="container">
    <?php if (session()->getFlashdata('message')): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border-left: 5px solid #28a745;">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <h2>Add New Task</h2>
        <form action="<?= site_url('tasks/create') ?>" method="post" class="add-task-form">
            <input type="text" name="title" placeholder="Enter task description here..." required>
            <button type="submit" class="btn btn-add">Create Task</button>
        </form>
    </div>

    <div class="card">
        <h1 style="margin-top:0; color: #2c3e50;">Active Managed Tasks</h1>
        <table class="task-table">
            <?php if (!empty($tasks)): foreach ($tasks as $task): ?>
                <tr>
                    <td>
                        <strong style="color: #2c3e50;"><?= esc($task['title']) ?></strong><br>
                        <span class="status-badge"><?= strtoupper(esc($task['status'])) ?></span>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= site_url('tasks/edit/'.$task['id']) ?>" style="color: #3498db; text-decoration:none; font-weight:bold; margin-right:20px;">Edit Task</a>
                        <a href="<?= site_url('tasks/delete/'.$task['id']) ?>" style="color: #e74c3c; text-decoration:none; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td style="text-align: center; color: #95a5a6; padding: 40px;">No tasks are currently being managed.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="card" style="border-left: 4px solid #3498db;">
        <h2 style="font-size: 0.9em; margin-bottom: 20px;">Global Task Registry (API Data)</h2>
        <div class="api-grid">
            <?php if (!empty($external_todos)): foreach ($external_todos as $todo): ?>
                <div class="api-item">
                    <div>
                        <div style="font-size: 0.8em; color: #7f8c8d; margin-bottom: 5px;">User ID: #<?= esc($todo['userId']) ?></div>
                        
                        <div style="font-weight: bold; font-size: 0.9em; line-height: 1.3; min-height: 40px; color: #34495e;">
                            <?= esc($todo['todo']) ?>
                        </div>
                    </div>
                    
                    <div style="margin-top: 15px; padding-top: 10px; border-top: 1px solid #eee;">
                        <span class="status-badge" style="background: <?= $todo['completed'] ? '#d4edda' : '#fff3cd' ?>; color: <?= $todo['completed'] ? '#155724' : '#856404' ?>;">
                            <?= esc($todo['status_label']) ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <p style="color: #e74c3c; text-align: center; width: 100%;">Registry offline.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>