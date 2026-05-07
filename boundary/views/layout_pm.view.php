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
            font-size: .8rem;
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
            background: #fff;
            font-size: 1rem;
        }
        .menu a:hover { background: #f9fafb; }
        .menu a.active {
            border-color: #2563eb;
            color: #2563eb;
            font-weight: 600;
        }
        .menu-dropdown {
            width: 100%;
        }
        .menu-dropdown > summary {
            list-style: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background: #fff;
            color: #111827;
            font-size: 1rem;
        }
        .menu-dropdown > summary::-webkit-details-marker { display: none; }
        .menu-dropdown > summary::after {
            content: "\25BC";
            font-size: 0.7rem;
            color: #6b7280;
            transition: transform 0.2s ease;
        }
        .menu-dropdown[open] > summary::after { transform: rotate(180deg); }
        .menu-dropdown > summary:hover { background: #f9fafb; }
        .menu-dropdown > summary.active {
            border-color: #2563eb;
            color: #2563eb;
            font-weight: 600;
        }
        .menu-dropdown .submenu {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 8px;
            padding-left: 12px;
        }
        .menu-dropdown .submenu a {
            font-size: 0.95rem;
            padding: 10px 14px;
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
            background: #fff;
        }
        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #fff;
            color: #111827;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }
        .btn:hover { background: #f9fafb; }
        .content {
            padding: 34px 28px;
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
        .modal-card h3 { margin: 0 0 .5rem; font-size: 1rem; }
        .modal-card p { margin: 0; color: #4b5563; font-size: .9rem; }
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
        .btn-danger:hover { background: #b91c1c; }
        .alert-popup {
            max-width: 100%;
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
        .form-card {
            max-width: 920px;
            margin-top: 24px;
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
            background: #fff;
            font: inherit;
            box-sizing: border-box;
        }
        select.form-control { cursor: pointer; }
		
		/* View Category */
		.category-container {
			background: #ffffff;
			border-radius: 12px;
			padding: 16px;
			margin-top: 10px;
		}

		.category-header {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr;
			font-weight: bold;
			padding: 10px;
			background: #ffffff;
			border: 1px solid #ccc;
			border-radius: 8px; 
		}

		.category-body {
			max-height: 300px;
			overflow-y: auto;
			margin-top: 10px;
			border-radius: 8px;
			border: 1px solid #ddd;
			border-radius: 8px;
			margin-bottom: 8px;
			background: #fff;
		}

		.category-row {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr;
			padding: 12px;
			border-bottom: 1px solid #ccc;
		}

		.category-row:hover {
			background: #eee;
		}
		
		.category-header,
		.category-row {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr;
			align-items: center; 
			text-align: center; 
		}

		.no-data {
			padding: 12px;
			color: #888;
		}
		
		/*Edit FRA Category*/
		.edit-category-container {
			background: #ffffff;
			border-radius: 12px;
			padding: 16px;
			margin-top: 10px;
		}

		.edit-category-header {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			font-weight: bold;
			padding: 10px;
			background: #ffffff;
			border: 1px solid #ccc;
			border-radius: 8px; 
			margin-right: 17px; 
		}

		.edit-category-body {
			max-height: 300px;
			overflow-y: auto;
			margin-top: 10px;
			border-radius: 8px;
			border: 1px solid #ddd;
			border-radius: 8px;
			margin-bottom: 8px;
			background: #fff;
		}

		.edit-category-row {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			padding: 12px;
			border-bottom: 1px solid #ccc;
		}

		.edit-category-row:hover {
			background: #eee;
		}
		
		.edit-category-header,
		.edit-category-row {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			align-items: center; 
			text-align: center; 
		}
		
		.edit-category-header span:last-child,
		.edit-category-row span:last-child {
			display: flex;
			justify-content: center;
			align-items: center;
		}
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">Avatar</div>
        <nav class="menu">
            <a href="dashboard_pm.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>
            <a href="create_cat.php" class="<?= $activePage === 'create_cat' ? 'active' : '' ?>">➕ Create FRA Category</a>
            <a href="view_cat.php" class="<?= $activePage === 'view_cat' ? 'active' : '' ?>">📄 View FRA Category</a>
            <a href="edit_cat.php" class="<?= $activePage === 'edit_cat' ? 'active' : '' ?>">✏️ Edit FRA Category</a>
            <a href="delete_cat.php" class="<?= $activePage === 'delete_cat' ? 'active' : '' ?>">🗑️ Delete FRA Category</a>
            <a href="search_cat.php" class="<?= $activePage === 'search_cat' ? 'active' : '' ?>">🔍 Search FRA Category</a>

            <?php $reportOpen = in_array($activePage, ['daily_report', 'weekly_report', 'monthly_report'], true); ?>
            <details class="menu-dropdown" <?= $reportOpen ? 'open' : '' ?>>
                <summary class="<?= $reportOpen ? 'active' : '' ?>">📊 Generate Report</summary>
                <div class="submenu">
                    <a href="daily_report.php" class="<?= $activePage === 'daily_report' ? 'active' : '' ?>">📅 Daily Report</a>
                    <a href="weekly_report.php" class="<?= $activePage === 'weekly_report' ? 'active' : '' ?>">📆 Weekly Report</a>
                    <a href="monthly_report.php" class="<?= $activePage === 'monthly_report' ? 'active' : '' ?>">🗓️ Monthly Report</a>
                </div>
            </details>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2>Dashboard</h2>
            <div class="topbar-right">
                <div class="avatar-small">PM</div>
                <button type="button" class="btn" onclick="showLogout()">Logout</button>
            </div>
        </header>

        <section class="content">
            <?php include $contentView; ?>
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