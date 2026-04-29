<?php
$activePage = $activePage ?? '';
$pageTitle = $pageTitle ?? 'Dashboard';
$contentView = $contentView ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
        <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #ffffff;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 210px;
            border-right: 1px solid #e5e7eb;
            padding: 18px 14px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .logo {
            width: 64px;
            height: 64px;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu a {
            display: block;
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            text-decoration: none;
            color: #111827;
            background: #ffffff;
            font-size: 1rem;
        }

        .menu a:hover {
            background: #f9fafb;
        }

        .menu a.active {
            border-color: #2563eb;
            color: #2563eb;
            font-weight: 600;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #d1d5db;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: #6b7280;
            background: #ffffff;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            color: #111827;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }

        .btn:hover {
            background: #f9fafb;
        }

        .content {
            padding: 34px 28px;
        }

        .content h1 {
            margin: 0 0 14px;
            font-size: 2rem;
            font-weight: 800;
        }

        .content p {
            margin: 0;
            color: #374151;
            font-size: 1rem;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal.open {
            display: flex;
        }

        .modal-card {
            width: 320px;
            background: #ffffff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .modal-card h3 {
            margin: 0 0 8px;
            font-size: 1.05rem;
        }

        .modal-card p {
            margin: 0;
            color: #4b5563;
        }

        .modal-actions {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-danger {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .alert-popup {
            max-width: 920px;
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .alert-popup.success {
            background: #ecfdf3;
            border-color: #86efac;
            color: #166534;
        }

        .alert-popup.error {
            background: #fef2f2;
            border-color: #fca5a5;
            color: #991b1b;
        }

        .alert-close {
            background: transparent;
            border: none;
            color: inherit;
            font-size: 1rem;
            cursor: pointer;
        }

        .alert-popup.cancel {
            background: #f3f4f6;
            border-color: #d1d5db;
            color: #4b5563;
        }

        .table-wrap {
            max-width: 1100px;
            margin-top: 24px;
            overflow-x: auto;
        }

/* shared base table style */
.table-base {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
}

.table-base th,
.table-base td {
    border: 1px solid #111827;
    padding: 12px;
    text-align: center;
    vertical-align: middle;
}

.table-base th {
    font-weight: 700;
}


.search-fra-toolbar {
    margin: 18px 0 20px;
}

.search-fra-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-fra-input {
    width: 260px;
    padding: 10px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font: inherit;
    background: #ffffff;
}

.search-fra-btn {
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    background: #111827;
    color: #ffffff;
    font-weight: 600;
    cursor: pointer;
}

.search-fra-btn:hover {
    background: #1f2937;
}

.search-fra-table td {
    vertical-align: middle;
}

.search-fra-table tr:hover {
    background: #f9fafb;
}

/* description column for search table */
.search-fra-table td:nth-child(5),
.search-fra-table th:nth-child(5) {
    width: 320px;
    max-width: 320px;
    white-space: normal;
    word-break: break-word;
    line-height: 1.4;
    text-align: center;
}

.search-input-wrapper {
    position: relative;
    display: inline-block;
}

.search-fra-input {
    width: 260px;
    padding: 10px 38px 10px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font: inherit;
    background: #ffffff;
}

.search-clear-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    text-decoration: none;
    color: #6b7280;
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1;
}

.search-clear-btn:hover {
    color: #111827;
}

.action-btn {
    display: inline-block;
    padding: 5px 10px;
    margin: 2px;
    border: 1px solid #111827;
    border-radius: 5px;
    text-decoration: none;
    color: #111827;
    background: #ffffff;
    font-size: 0.85rem;
}

.action-btn:hover {
    background: #f3f4f6;
}

.search-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 1100px;
    margin-bottom: 20px;
}

.no-result-message {
    width: 1100px;
    margin: 40px auto 0;
    text-align: center;
    font-size: 1rem;
}

.view-btn,
.save-btn {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    margin: 2px;
    transition: 0.2s ease;
}

.view-btn {
    border: 1px solid #2563eb;
    color: #2563eb;
    background: #eff6ff;
}

.view-btn:hover {
    background: #dbeafe;
}

.save-btn {
    border: 1px solid #16a34a;
    color: #16a34a;
    background: #f0fdf4;
}

.save-btn:hover {
    background: #dcfce7;
}

.fra-detail-card {
    max-width: 760px;
    margin-top: 24px;
    padding: 28px;
    border: 1px solid #d1d5db;
    border-radius: 16px;
    background: #ffffff;
}

.fra-detail-card h2 {
    margin: -28px -28px 24px;
    padding: 18px 28px;
    background: #eff6ff;
    border-bottom: 1px solid #bfdbfe;
    border-radius: 16px 16px 0 0;
    color: #1d4ed8;
    font-size: 1.5rem;
    font-weight: 800;
}

.fra-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px 28px;
}

.fra-detail-card p {
    margin: 0;
    line-height: 1.5;
}

.fra-description-box {
    margin-top: 24px;
    padding: 16px;
    border-radius: 12px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}

.fra-description-box p {
    margin-top: 10px;
}

.fra-detail-actions {
    margin-top: 24px;
    display: flex;
    justify-content: flex-end;
}

.back-btn {
    display: inline-block;
    padding: 10px 18px;
    border-radius: 8px;
    background: #2563eb;
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    transition: 0.2s ease;
}

.back-btn:hover {
    background: #1d4ed8;
}
</style>
</head>
<body>
<div class="layout">

    <aside class="sidebar">
        <div class="logo">Avatar</div>

        <nav class="menu">
            <a href="dashboard_dn.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>
            <a href="search_dn_fra.php" class="<?= $activePage === 'browse_fra' ? 'active' : '' ?>">🔍 Browse FRA</a>
            <a href="view_dn_fav_fra.php" class="<?= $activePage === 'favourite_fra' ? 'active' : '' ?>">⭐ Saved FRA</a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2><?= htmlspecialchars($pageTitle) ?></h2>

            <div class="topbar-right">
                <div class="avatar-small">DN</div>
                <button type="button" class="btn" onclick="showLogout()">Logout</button>
            </div>
        </header>

        <section class="content">
            <?php if (!empty($contentView)) include $contentView; ?>
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
