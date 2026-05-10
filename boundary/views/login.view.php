<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #111827;
        }

        .card {
            width: 420px;
            background: #ffffff;
            padding: 36px;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        }

        .logo {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin: 0 0 24px;
            font-size: 0.95rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 18px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-top: 8px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font: inherit;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        button {
            width: 100%;
            padding: 13px 16px;
            margin-top: 4px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .success {
            background: #ecfdf5;
            color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 10px 14px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .error {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 10px 14px;
            border-radius: 10px;
            text-align: center;
            margin-top: 16px;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <form class="card" method="post" action="">

        <div class="logo">Avatar</div>

        <h1>Login</h1>

        <p class="subtitle">
            Explore and manage fundraising activities
        </p>

        <?php if (!empty($message)): ?>
            <div class="success">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <label>
            Username
            <input type="text" name="username" autofocus required>
        </label>

        <label>
            Password
            <input type="password" name="password" required>
        </label>

        <button type="submit">
            Login
        </button>

        <?php if (!empty($error)): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

    </form>

</body>
</html>