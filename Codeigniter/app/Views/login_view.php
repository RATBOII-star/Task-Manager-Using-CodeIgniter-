<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Login</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .login-card { 
            background: white; 
            padding: 40px; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 350px; 
        }
        h2 { 
            text-align: center; 
            color: #333; 
            margin-bottom: 25px; 
            margin-top: 0;
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
            color: #666; 
            font-size: 0.9em; 
        }
        input[type="text"], input[type="password"] { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        .login-btn { 
            width: 100%; 
            padding: 12px; 
            background-color: #2c3e50; /* Changed to match your Dashboard navbar */
            color: white; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 1em; 
            font-weight: bold; 
            transition: background 0.3s; 
        }
        .login-btn:hover { 
            background-color: #34495e; 
        }
        /* Style for Success Messages (Registration success) */
        .alert-success { 
            background-color: #d4edda; 
            color: #155724; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
            font-size: 0.85em; 
            text-align: center; 
            border: 1px solid #c3e6cb;
        }
        /* Style for Error Messages */
        .alert-danger { 
            background-color: #f8d7da; 
            color: #721c24; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
            font-size: 0.85em; 
            text-align: center; 
            border: 1px solid #f5c6cb;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85em;
            color: #999;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Login</h2>

    <?php if(session()->getFlashdata('message')): ?>
        <div class="alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/loginProcess') ?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit" class="login-btn">Sign In</button>
    </form>

    <div style="text-align: center; margin-top: 15px; font-size: 0.9em;">
        Don't have an account? <a href="<?= site_url('register') ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Register here</a>
    </div>

    <div class="footer-text">
        Task Manager System v1.0
    </div>
</div>

</body>
</html>