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
    text-decoration: none;

    
    display: inline-flex;
    align-items: center;
    justify-content: center;
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
/* View FRA table container */
.view-fra-container {
    width: 95%;
    margin-left: 0;
}

/* table */
.view-fra-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #fff;
}

/* cells */
.view-fra-table th,
.view-fra-table td {
    border: 1px solid #e5e7eb;
    padding: 16px 12px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}

/* description column */
.view-fra-table th:nth-child(5),
.view-fra-table td:nth-child(5) {
    width: 25%;
    white-space: normal;
    word-break: break-word;
}

/* Delete FRA table */
/* Delete FRA container */
.delete-fra-container {
    width: 95%;
    margin-left: 0;
}

/* Delete FRA table */
.delete-fra-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #fff;
}

/* table cells */
.delete-fra-table th,
.delete-fra-table td {
    border: 1px solid #e5e7eb;
    padding: 16px 12px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}

/* column widths */
.delete-fra-table th:nth-child(1),
.delete-fra-table td:nth-child(1) {
    width: 10%;
}

.delete-fra-table th:nth-child(2),
.delete-fra-table td:nth-child(2) {
    width: 10%;
}

.delete-fra-table th:nth-child(3),
.delete-fra-table td:nth-child(3) {
    width: 8%;
}

.delete-fra-table th:nth-child(4),
.delete-fra-table td:nth-child(4) {
    width: 8%;
}

/* description column */
.delete-fra-table th:nth-child(5),
.delete-fra-table td:nth-child(5) {
    width: 8%;
    
}

.delete-fra-table th:nth-child(6),
.delete-fra-table td:nth-child(6) {
    width: 8%;
}

.delete-fra-table th:nth-child(7),
.delete-fra-table td:nth-child(7) {
    width: 8%;
}

/* action column */
.delete-fra-table th:last-child,
.delete-fra-table td:last-child {
    width: 8%;
}

/* Update FRA list table */
/* table wrapper */
.update-fra-container {
    width: 95%;
    margin-left: 0;
}

/* table */
.update-fra-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #fff;
}

/* cells */
.update-fra-table th,
.update-fra-table td {
    border: 1px solid #d1d5db;
    padding: 16px 12px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}

/* column sizing */
.update-fra-table th:nth-child(1),
.update-fra-table td:nth-child(1) {
    width: 12%;
}

.update-fra-table th:nth-child(2),
.update-fra-table td:nth-child(2) {
    width: 12%;
}

.update-fra-table th:nth-child(3),
.update-fra-table td:nth-child(3) {
    width: 10%;
}

.update-fra-table th:nth-child(4),
.update-fra-table td:nth-child(4) {
    width: 10%;
}

.update-fra-table th:nth-child(5),
.update-fra-table td:nth-child(5) {
    width: 25%;
    white-space: normal;
    word-break: break-word;
}

.update-fra-table th:nth-child(6),
.update-fra-table td:nth-child(6) {
    width: 10%;
}

.update-fra-table th:nth-child(7),
.update-fra-table td:nth-child(7) {
    width: 10%;
}

.update-fra-table th:nth-child(8),
.update-fra-table td:nth-child(8) {
    width: 10%;
}

/* Search FRA toolbar */
.search-fra-toolbar {
    margin: 18px 0 20px;
}

.search-fra-form {
    display: flex;
    align-items: center;
    gap: 10px;
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
    box-sizing: border-box;
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

.view-fra-table tr:hover {
    background: #f9fafb;
}

.update-fra-table tr:hover {
    background: #f9fafb;
}

.delete-fra-table tr:hover {
    background: #f9fafb;
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

/* Search FRA container */
.search-fra-container {
    width: 95%;
    margin-left: 0;
}

/* Search FRA table */
.search-fra-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    background: #fff;
}

/* table cells */
.search-fra-table th,
.search-fra-table td {
    border: 1px solid #e5e7eb;
    padding: 16px 12px;
    text-align: center;
    vertical-align: middle;
    word-wrap: break-word;
}

/* row hover */
.search-fra-table tr:hover {
    background: #f9fafb;
}

/* description column */
.search-fra-table th:nth-child(5),
.search-fra-table td:nth-child(5) {
    width: 28%;
    white-space: normal;
    word-break: break-word;
    line-height: 1.4;
}

/* donee */
.search-fra-table th:nth-child(6),
.search-fra-table td:nth-child(6) {
    width: 10%;
}

/* phone */
.search-fra-table th:nth-child(7),
.search-fra-table td:nth-child(7) {
    width: 10%;
}

/* fundraiser */
.search-fra-table th:nth-child(8),
.search-fra-table td:nth-child(8) {
    width: 12%;
}

.stats-summary {
    display: flex;
    gap: 20px;
    margin: 20px 0 24px;
}

.stats-card {
    border: 1px solid #d1d5db;
    border-radius: 12px;
    padding: 18px 22px;
    background: #f9fafb;
    min-width: 240px;
}

.menu a {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.submenu-child {
    margin-left: 4px;
    margin-top: 6px;
    width: calc(100% - 16px);

    font-size: 14px;
    padding: 10px 14px;

    border-radius: 12px;
}

.submenu-child.active {
    border: 1px solid #2563eb;
    color: #2563eb;
    background: #eff6ff;
}

.statistics-table th:nth-child(5),
.statistics-table td:nth-child(5) {
    width: 140px;
    text-align: center;
}

.view-badge {
    background: #eff6ff;
    color: #2563eb;

    padding: 6px 12px;
    border-radius: 999px;

    font-weight: 600;
    font-size: 14px;

    display: inline-block;
    min-width: 32px;
    text-align: center;
}

/* Completed FRA page header */
.completed-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-right: 90px;
    margin-bottom: 24px;
    box-sizing: border-box;
}

/* Right align search */
.completed-search-toolbar {
    display: flex;
    justify-content: flex-end;
}

.dashboard-content {
    padding: 32px;
    background: #f8fafc;
    min-height: 100vh;
}

.welcome-card {
    background: white;
    padding: 28px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    margin-bottom: 28px;
}

.welcome-card h1 {
    margin: 0 0 8px;
    font-size: 36px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 28px;
}

.stat-card {
    background: white;
    padding: 22px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    gap: 16px;
}

.stat-icon {
    width: 55px;
    height: 55px;
    border-radius: 14px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-card p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}

.stat-card h2 {
    margin: 6px 0 0;
    font-size: 28px;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 24px;
}

.panel {
    background: white;
    padding: 24px;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
}

.panel h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.fra-table {
    width: 100%;
    border-collapse: collapse;
}

.fra-table th,
.fra-table td {
    padding: 16px 10px;
    border-bottom: 1px solid #e5e7eb;
    text-align: left;
}

.progress-bar {
    width: 120px;
    height: 8px;
    background: #e5e7eb;
    border-radius: 999px;
    overflow: hidden;
    margin-top: 6px;
}

.progress-bar div {
    height: 100%;
    background: #2563eb;
    border-radius: 999px;
}

.status-active {
    background: #dcfce7;
    color: #15803d;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
}

.activity-item {
    display: flex;
    gap: 14px;
    padding: 16px 0;
    border-bottom: 1px solid #e5e7eb;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-item p {
    margin: 4px 0 0;
    color: #64748b;
    font-size: 14px;
}

.table-scroll {
    max-height: 420px;
    overflow-y: auto;
    overflow-x: auto;
}

.fra-table {
    width: 100%;
    border-collapse: collapse;
}

.fra-table thead th {
    position: sticky;
    top: 0;
    background: white;
    z-index: 2;
}

/* Dashboard polish effects */
.stat-card,
.panel,
.welcome-card {
    transition: all 0.2s ease;
}

.stat-card:hover,
.panel:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
}

.activity-item {
    transition: background 0.2s ease;
    border-radius: 12px;
    padding: 16px;
}

.activity-item:hover {
    background: #f8fafc;
}

.fra-table tbody tr {
    transition: background 0.2s ease;
}

.fra-table tbody tr:hover {
    background: #f8fafc;
}

</style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">Avatar</div>

        <nav class="menu">
    <a href="dashboard_fr.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>
    <a href="create_fra.php" class="<?= $activePage === 'create_fra' ? 'active' : '' ?>">➕ Create FRA</a>
    <a href="view_fra.php"
   class="<?= $activePage === 'view_fra' ? 'active' : '' ?>">
   <span>📄 View FRA</span>
   <span class="arrow">▼</span>
</a>

<?php if (
    $activePage === 'view_fra' ||
    $activePage === 'view_statistics' ||
    $activePage === 'view_shortlist' ||
	$activePage === 'view_completed'
): ?>

    <a href="view_num_fra.php"
       class="submenu-child <?= $activePage === 'view_statistics' ? 'active' : '' ?>">
       📊 View Statistics
    </a>

    <a href="view_shortlisted_fra.php"
       class="submenu-child <?= $activePage === 'view_shortlist' ? 'active' : '' ?>">
       🔖 View Shortlist
    </a>
	
	<a href="view_completed_fra.php"
       class="submenu-child <?= $activePage === 'view_completed' ? 'active' : '' ?>">
       📚  View Completed
    </a>

<?php endif; ?>
    <a href="update_fra.php" class="<?= $activePage === 'update_fra' ? 'active' : '' ?>">✏️ Update FRA</a>
    <a href="delete_fra.php" class="<?= $activePage === 'delete_fra' ? 'active' : '' ?>">🗑️ Delete FRA</a>
    <a href="search_fra.php" class="<?= $activePage === 'search_fra' ? 'active' : '' ?>">🔍 Search FRA</a>
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

    function toggleSubmenu() {

    const submenu = document.getElementById('fraSubmenu');
    const arrow = document.getElementById('dropdownArrow');

    submenu.classList.toggle('show');

    if (submenu.classList.contains('show')) {
        arrow.textContent = '▼';
    } else {
        arrow.textContent = '▶';
    }
}
</script>
</body>
</html>