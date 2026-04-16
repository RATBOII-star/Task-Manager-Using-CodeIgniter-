<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task | Task Manager Pro</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .edit-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        h2 { color: #2c3e50; margin-top: 0; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        label { display: block; margin-top: 20px; font-weight: bold; font-size: 0.9em; color: #34495e; }
        input, select { width: 100%; padding: 12px; margin-top: 8px; border: 1px solid #dcdde1; border-radius: 5px; box-sizing: border-box; font-size: 1em; }
        .btn-container { margin-top: 25px; display: flex; gap: 10px; }
        .btn-save { background: #27ae60; color: white; border: none; padding: 12px; flex: 2; border-radius: 5px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .btn-save:hover { background: #219150; }
        .btn-cancel { background: #95a5a6; color: white; text-decoration: none; padding: 12px; flex: 1; border-radius: 5px; text-align: center; font-weight: bold; }
    </style>
</head>
<body>

<div class="edit-card">
    <h2>Update Task Details</h2>
    
    <form action="<?= site_url('tasks/update/' . $task['id']) ?>" method="post">
        
        <label>Task Description</label>
        <input type="text" name="title" value="<?= esc($task['title']) ?>" required>

        <label>Task Status</label>
        <select name="status">
            <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="in_progress" <?= $task['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
        </select>

        <div class="btn-container">
            <button type="submit" class="btn-save">Save Changes</button>
            <a href="<?= site_url('tasks') ?>" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>