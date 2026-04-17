<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f4f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,.08); width: 320px; }
        h1 { margin: 0 0 1rem; font-size: 1.25rem; text-align: center; }
        label { display: block; font-size: .85rem; margin-top: .75rem; }
        input { width: 100%; padding: .5rem; margin-top: .25rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { margin-top: 1rem; width: 100%; padding: .6rem; background: #2563eb; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .error { color: #b91c1c; font-size: .85rem; margin-top: .75rem; }
        .success { color: #059669; font-size: .85rem; text-align: center; margin-top: -.5rem; margin-bottom: .5rem; }
    </style>
</head>
<body>
    <form class="card" method="post" action="">
        <h1>Login</h1>
        <?php if (!empty($message)): ?>
            <div class="success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <label>Username
            <input type="text" name="username" autofocus required>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Login</button>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
