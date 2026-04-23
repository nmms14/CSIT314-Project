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

        .form-card {
            max-width: 920px;
            margin-top: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #ffffff;
            font: inherit;
        }

        textarea.form-control {
            resize: vertical;
        }

        .money-input {
            display: flex;
            align-items: center;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff;
        }

        .money-input span {
            padding: 0 14px;
            border-right: 1px solid #d1d5db;
        }

        .money-input input {
            flex: 1;
            padding: 12px 14px;
            border: none;
            outline: none;
            font: inherit;
        }

        .file-list {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            margin-bottom: 8px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #ffffff;
        }

        .table-wrap {
            max-width: 1100px;
            margin-top: 24px;
            overflow-x: auto;
        }

        .topbar-link {
    color: inherit;
    text-decoration: none;
}

.create-form-card {
    max-width: 760px;
    margin: 24px 0 0;
    padding: 28px;
    border: 1px solid #d1d5db;
    border-radius: 14px;
    background: #ffffff;
}

.create-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 18px;
}

.create-form-group {
    margin-bottom: 18px;
}

.create-form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
}

.create-form-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 10px;
}

.create-cancel-btn,
.create-save-btn {
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
}

.create-cancel-btn {
    background: #d1d5db;
    color: #111827;
}

.create-save-btn {
    background: #2563eb;
    color: #ffffff;
}

.create-save-btn:hover {
    background: #1d4ed8;
}

.create-file-input {
    display: block;
    width: auto;
    padding: 0;
    border: none;
    border-radius: 0;
    background: transparent;
    font: inherit;
}

.create-file-note {
    margin-top: 10px;
    color: #6b7280;
    font-size: 0.95rem;
}

.topbar-link:hover {
    text-decoration: underline;
}

.desc-header {
    text-align: center;
}

.delete-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    justify-content: center;
    align-items: center;
    z-index: 2000;
}

.delete-modal-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    width: 350px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.delete-modal-actions {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.delete-btn-confirm {
    background: #dc2626;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.delete-btn-confirm:hover {
    background: #b91c1c;
}

.delete-btn-cancel {
    background: #ccc;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.delete-btn {
    background: #ef4444;          /* red */
    color: #ffffff;
    border: none;
    padding: 5px 14px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.delete-btn:hover {
    background: #dc2626;          /* darker red */
    transform: translateY(-1px);  /* slight lift */
}

.delete-btn:active {
    transform: scale(0.95);
}

.edit-btn {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 8px;
    background: #2563eb;
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.edit-btn:hover {
    background: #1d4ed8;
    transform: translateY(-1px); 
}

.update-form-card {
    max-width: 760px;
    margin: 24px 0 0;
    padding: 28px;
    border: 1px solid #d1d5db;
    border-radius: 14px;
    background: #ffffff;
}

.update-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 18px;
}

.update-form-group {
    margin-bottom: 18px;
}

.update-form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
}

.update-form-actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 10px;
}

.update-cancel-btn,
.update-save-btn {
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.update-cancel-btn {
    background: #d1d5db;
    color: #111827;
}

.update-save-btn {
    background: #2563eb;
    color: #ffffff;
}

.update-save-btn:hover {
    background: #1d4ed8;
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

/* FRA View table */
.view-fra-table {
    width: 100%;
}

/* Delete FRA table */
.delete-fra-table {
    width: 100%;
}

.delete-fra-table th:last-child,
.delete-fra-table td:last-child {
    width: 110px;
}

/* Update FRA list table */
.update-fra-table {
    width: 100%;
}

.update-fra-table th:last-child,
.update-fra-table td:last-child {
    width: 110px;
}

/* description column for update table */
.update-fra-table td:nth-child(5) {
    white-space: nowrap;
    overflow: hidden;
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
.search-fra-table td:nth-child(5) {
    max-width: 240px;
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

</style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">Avatar</div>

        <nav class="menu">
            <a href="create_fra.php" class="<?= $activePage === 'create_fra' ? 'active' : '' ?>">Create FRA</a>
            <a href="view_fra.php" class="<?= $activePage === 'view_fra' ? 'active' : '' ?>">View FRA</a>
            <a href="update_fra.php" class="<?= ($page ?? '') === 'update_fra' ? 'active' : '' ?>">Update FRA</a>
            <a href="delete_fra.php" class="<?= ($page ?? '') === 'delete_fra' ? 'active' : '' ?>">Delete FRA</a>
            <a href="search_fra.php" class="<?= ($page ?? '') === 'search_fra' ? 'active' : '' ?>">Search FRA</a>
            <a href="settings.php" class="<?= ($page ?? '') === 'settings' ? 'active' : '' ?>">Settings</a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2>Dashboard</h2>

            <div class="topbar-right">
                <div class="avatar-small">FR</div>
                <button type="button" class="btn" onclick="showLogout()">Logout</button>
            </div>
        </header>

        <section class="content">
            <?php if (isset($contentView)) include $contentView; ?>
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
    function showLogout() {
        document.getElementById('logoutModal').classList.add('open');
    }

    function hideLogout() {
        document.getElementById('logoutModal').classList.remove('open');
    }
</script>
</body>
</html>