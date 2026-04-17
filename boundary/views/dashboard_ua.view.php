<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Admin Dashboard</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #fff;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            border-right: 1px solid #e5e7eb;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo {
            width: 64px;
            height: 64px;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            color: #6b7280;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eef2ff;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 600;
            border: 1px solid #e5e7eb;
        }

        .btn {
            display: inline-block;
            padding: .45rem 1rem;
            font-size: .875rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            color: #111827;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #f9fafb;
        }

        .content {
            padding: 2rem 1.5rem;
            flex: 1;
        }

        .content h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .modal.open { display: flex; }

        .modal-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }

        .modal-card h3 {
            margin: 0 0 .5rem;
            font-size: 1rem;
        }

        .modal-card p {
            margin: 0;
            color: #4b5563;
            font-size: .9rem;
        }

        .modal-actions {
            display: flex;
            gap: .5rem;
            justify-content: center;
            margin-top: 1.25rem;
        }

        .btn-danger {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo">Avatar</div>
        </aside>

        <main class="main">
            <header class="topbar">
                <h2>Dashboard</h2>
                <div class="actions">
                    <div class="avatar">UA</div>
                    <button class="btn" type="button" onclick="showLogout()">Logout</button>
                </div>
            </header>

            <section class="content">
                <h1>Welcome, <?= $username ?>!</h1>
            </section>
        </main>
    </div>

    <div class="modal" id="logoutModal">
        <div class="modal-card">
            <h3>Logout Confirmation</h3>
            <p>Are you sure you want to logout?</p>
            <div class="modal-actions">
                <a class="btn btn-danger" href="logout.php">Yes</a>
                <button type="button" class="btn" onclick="hideLogout()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function showLogout() { document.getElementById('logoutModal').classList.add('open'); }
        function hideLogout() { document.getElementById('logoutModal').classList.remove('open'); }
    </script>
</body>
</html>
