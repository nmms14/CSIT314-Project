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
		* {
			box-sizing: border-box;
		}

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
			box-shadow: 2px 0 12px rgba(15, 23, 42, 0.03);
		}

		.logo {
			width: 72px;
			height: 72px;

			border-radius: 50%;

			background: linear-gradient(135deg, #2563eb, #60a5fa);

			display: flex;
			align-items: center;
			justify-content: center;

			font-size: 0.95rem;
			font-weight: 700;
			letter-spacing: 0.5px;

			color: white;

			box-shadow: 0 6px 18px rgba(37, 99, 235, 0.18);

			flex-shrink: 0;
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
			white-space: nowrap;
			transition: all 0.2s ease;
		}

		.menu a:hover {
			background: #f9fafb;
			transform: translateX(3px);
		}

		.menu a.active {
			background: #eff6ff;
			border-color: #bfdbfe;
			color: #2563eb;
			font-weight: 600;
		}

		.menu-section-gap {
			height: 10px;
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

			background: #f8fafc;
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
			width: 46px;
			height: 46px;
			border-radius: 50%;

			background: linear-gradient(135deg, #dbeafe, #eff6ff);
			border: 1px solid #bfdbfe;

			display: flex;
			align-items: center;
			justify-content: center;

			font-size: 0.9rem;
			font-weight: 700;

			color: #2563eb;

			box-shadow: 0 2px 8px rgba(37, 99, 235, 0.08);
		}

		.btn-logout {
			padding: 11px 16px;

			background: #fef2f2;
			color: #dc2626;
			border: 1px solid #fecaca;

			border-radius: 12px;

			font-weight: 600;

			transition: all 0.2s ease;
		}

		.btn-logout:hover {
			background: #fee2e2;
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

		.btn:hover {
			background: #f9fafb;
		}

		.content {
			padding: 34px 28px;
		}

		.modal {
			position: fixed;
			inset: 0;

			background: rgba(15, 23, 42, 0.35);

			backdrop-filter: blur(4px);

			display: none;
			align-items: center;
			justify-content: center;

			z-index: 1000;
		}

		.modal.open {
			display: flex;
		}

		.modal-card {
			width: 360px;

			background: #ffffff;

			border-radius: 20px;

			padding: 30px 28px;

			box-shadow:
				0 20px 40px rgba(15, 23, 42, 0.12),
				0 2px 10px rgba(15, 23, 42, 0.06);

			text-align: center;

			animation: modalPop 0.18s ease;
		}

		.modal-card h3 {
			margin: 0 0 10px;

			font-size: 1.3rem;
			font-weight: 700;

			color: #111827;
		}

		.modal-card p {
			margin: 0;

			color: #6b7280;

			line-height: 1.5;
		}

		.modal-actions {
			margin-top: 24px;

			display: flex;
			gap: 12px;

			justify-content: center;
		}

		.modal-actions .btn,
		.modal-actions .btn-danger {
			min-width: 90px;
		}

		@keyframes modalPop {
			from {
				opacity: 0;
				transform: scale(0.96) translateY(8px);
			}

			to {
				opacity: 1;
				transform: scale(1) translateY(0);
			}
		}

		.btn-danger {
			background: #dc2626;
			color: #fff;
			border-color: #dc2626;
		}

		.btn-danger:hover {
			background: #b91c1c;
		}

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

		select.form-control {
			cursor: pointer;
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
		
		.search-input-wrapper {
			position: relative;
		}

		.search-clear-btn {
			position: absolute;
			right: 12px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			color: #6b7280;
			font-size: 18px;
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
			padding: 12px 24px 12px 12px;
			box-sizing: border-box;
			font-weight: bold;
		}
		
		.user-list {
			overflow: visible;
		}

		.user-main {
			display: grid;
			grid-template-columns: 1fr 2fr 1fr 1fr;
			padding: 12px;
			align-items: center;
		}

		.header-row.prof-row,
		.user-main.prof-row {
			grid-template-columns: 1fr 2fr 1fr 1fr 1fr;
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
			width: 20px;
			/* bridge width */
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

			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
	position: sticky;
	bottom: 20px;

	display: flex;
	justify-content: flex-end;

	margin-top: 20px;
	padding-right: 10px;

	z-index: 100;
}

		.create-btn {
			padding: 10px 16px;
			font-weight: bold;
		}

		.search-wrapper {
			position: relative;
			display: inline-block;
		}

		.search-wrapper input {
			padding-right: 28px;
		}

		.clear-btn {
			position: absolute;
			right: 8px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			color: #6b7280;
			font-size: 1rem;
		}

		.clear-btn:hover {
			color: #111827;
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
			display: block;
			width: 100%;
			margin-bottom: 20px
		}

		.back-btn {
			font-size: 24px;
			text-decoration: none;
			color: #111827;
		}

		/*Update Account*/
		.btn-link-button {
			display: inline-block;
			text-decoration: none;
			color: inherit;
			text-align: center;
		}

		/*Dashboard*/
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

		.logout-icon {
			width: 64px;
			height: 64px;

			margin: 0 auto 18px;

			border-radius: 18px;

			background: #fef2f2;
			color: #dc2626;

			display: flex;
			align-items: center;
			justify-content: center;

			font-size: 30px;
		}
	</style>
</head>

<body>
	<div class="layout">
		<aside class="sidebar">
			<div class="logo">Avatar</div>
			<nav class="menu">
				<a href="dashboard_ua.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>

				<div class="menu-section-gap"></div>


				<a href="view_prof.php" class="<?= $activePage === 'view_prof' ? 'active' : '' ?>">👤 Manage Profiles</a>
				<a href="view_acc.php" class="<?= $activePage === 'view_accounts' ? 'active' : '' ?>">📇 Manage Accounts</a>
			</nav>
		</aside>

		<main class="main">
			<header class="topbar">
				<h2>Dashboard</h2>
				<div class="topbar-right">
					<div class="avatar-small">UA</div>
					<button type="button" class="btn-logout" onclick="showLogout()">Logout</button>
				</div>
			</header>

			<section class="content">
				<?php include $contentView; ?>
			</section>
		</main>
	</div>

	<div class="modal" id="logoutModal">
		<div class="modal-card">
			<div class="logout-icon">↩</div>
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