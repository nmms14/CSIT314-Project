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

        /*View Account CSS*/
		.header-top {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}
		.search-form {
			display: flex;
			align-items: center;
			gap: 6px;
		}
		.search-form input {
			padding: 6px 10px;
			border: 1px solid #d1d5db;
			border-radius: 6px;
		}

		.search-form button {
			padding: 6px 10px;
			border: 1px solid #d1d5db;
			border-radius: 6px;
			background: white;
			cursor: pointer;
		}
		.header-box {
			border: 2px solid #d1d5db;
			border-radius: 10px;
			overflow: hidden;
		}
		.body-box {
			border: 2px solid #d1d5db;
			border-radius: 10px;
			overflow: visible;
		}
		.header-row {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			padding: 12px;
			font-weight: bold;
			background: #f9fafb;
		}
		.user-main {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			padding: 12px;
			align-items: center;
		}
		.user-row {
			border-bottom: 1px solid #e5e7eb;
			position: relative;
		}
		.user-row:last-child {
			border-bottom: none;
		}
		.user-row:hover {
			background: #f9fafb;
		}
		.user-row::after {
			content: "";
			position: absolute;
			top: 0;
			left: 100%;
			width: 20px;   /* bridge width */
			height: 100%;
		}
		.hover-card {
			margin-left: 0;
			display: none;
			position: absolute;
			top: 50%;
			right: 10px;
			transform: translateY(-50%);
			z-index: 999;
		}
		.hover-card:hover {
			display: block;
		}
		.user-row:hover .hover-card {
			display: block;
		}
		.card-content {
			width: 180px;
			background: #ffffff;
			border: 1px solid #e5e7eb;
			border-radius: 10px;
			padding: 12px;
			text-align: center;

			box-shadow: 0 4px 10px rgba(0,0,0,0.1);
		}
		.avatar {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			background: #f3f4f6;
			display: flex;
			align-items: center;
			justify-content: center;
			font-weight: bold;
			margin: 0 auto 10px;
		}
		.create-container {
			position: absolute;
			bottom: 20px;
			right: 20px;
		}

		.create-btn {
			padding: 10px 16px;
			font-weight: bold;
		}
		
		/*View Account Details CSS*/
		.details-content {
			display: flex;
			gap: 40px;
			min-height: 500px; 
			align-items: center;
			justify-content: center;
		}
		.left-panel {
			width: 300px;
			display: flex;
			flex-direction: column; 
			align-items: center;
		}
		.action-buttons {
			margin-top: 10px;
			display: flex;
			flex-direction: column;
			gap: 10px;
			width: 100%;
		}
		.action-buttons .btn {
			width: 100%;
		}
		.avatar-large {
			width: 80px;
			height: 80px;
			border-radius: 50%;
			background: #eef2ff;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 28px;
			font-weight: bold;
			margin-bottom: 10px;
		}
		.form-box {
			border: 2px solid #d1d5db;
			border-radius: 16px;
			padding: 20px;
			width: 700px;
		}
		.form-group input {
			 margin-bottom: 14px;
		}
		.form-group label {
			display: block;
			font-size: 14px;
			margin-bottom: 4px;
		}
		.form-group input {
			width: 100%;
			padding: 8px 10px;
			border: 2px solid #d1d5db;  
			border-radius: 6px;
			font-size: 14px;
		}
		.back-container {
			position: relative;
			top: 20px;
			left: 20px;
		}

		.back-btn {
			font-size: 24px;
			text-decoration: none;
			color: #111827;
		}
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">Avatar</div>
        <nav class="menu">
            <a href="dashboard_ua.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
            <a href="manage_profiles.php">Manage Profiles</a>
            <a href="view_acc.php" class="<?= $activePage === 'view_acc' ? 'active' : '' ?>">Manage Accounts</a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <h2>Dashboard</h2>
            <div class="topbar-right">
                <div class="avatar-small">UA</div>
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
