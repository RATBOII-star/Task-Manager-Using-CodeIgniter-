<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager - Register</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        h2 { text-align: center; color: #333; margin-top: 0; }
        .form-group { margin-bottom: 20px; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn { width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1em; }
        .btn:hover { background-color: #218838; }
        /* Requirement: Ensure validation errors are visible */
        .alert { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; font-size: 0.85em; text-align: center; border: 1px solid #f5c6cb; }
        .link { text-align: center; margin-top: 15px; font-size: 0.9em; }
        .link a { color: #007bff; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <h2>Create Account</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('auth/store') ?>" method="post">
        <div class="form-group">
            <input type="text" name="username" placeholder="Choose a Username" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Create a Password" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>

    <div class="link">
        Already have an account? <a href="<?= site_url('login') ?>">Login here</a>
    </div>
</div>

</body>
</html>