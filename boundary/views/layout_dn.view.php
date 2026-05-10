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
            background: #ffffff;
            font-size: 1rem;
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
            min-width: 92px;

            padding: 10px 16px;

            border-radius: 12px;

            font-weight: 600;

            transition: all 0.2s ease;
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

        /* action column */
        .search-fra-table td:nth-child(5),
        .search-fra-table th:nth-child(5) {
            width: 180px;
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
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            background: #1d4ed8;
        }

        .saved-btn {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 3px;
            transition: 0.2s ease;
            border: 1px solid #666;
            color: #666;
            background: #ddd;
        }

        .fra-detail-actions {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        /* Dropdown */
        .dropdown-content {
            display: none;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
            margin-left: 3px;
        }

        .dropdown-content.show {
            display: flex;
        }

        .submenu-link {
            white-space: nowrap;
            width: 100%;
        }

        /* View Donation Progress Page */
        .progress-card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            margin-top: 20px;
            border: 1px solid #d1d5db;
        }

        .progress-header {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-header h2 {
            margin: 0;
        }

        .category-tag {
            font-size: 14px;
            color: gray;
        }

        .progress-info-row {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-top: 18px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .progress-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-bar {
            width: 300px;
            height: 14px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #60a5fa;
        }

        .progress-percent {
            font-weight: 600;
        }

        .dashboard-content {
            background: #f8fafc;
            min-height: 100vh;
        }

        .welcome-card,
        .stat-card,
        .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }

        .welcome-card {
            padding: 28px;
            margin-bottom: 28px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;

            margin-top: 22px;
            margin-bottom: 28px;
        }

        .stat-card {
            padding: 22px;
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
        }

        .stat-card h2 {
            margin: 6px 0 0;
            font-size: 28px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .donee-dashboard-container {
            background: #f8fafc;
            min-height: 100vh;
            max-width: 1600px;
            margin: 0 auto;
            padding: 24px 14px 32px;
        }

        .panel {
            padding: 24px 28px;
            height: 520px;
            overflow-y: auto;
        }

        .panel::-webkit-scrollbar {
            width: 8px;
        }

        .panel::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 999px;
        }

        .activity-item {
            display: flex;
            gap: 14px;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .activity-item {
            transition: background 0.2s ease;
            border-radius: 12px;
            padding: 16px;
        }

        .activity-item:hover {
            background: #f8fafc;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item p {
            margin: 4px 0 0;
            color: #64748b;
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 18px;

            flex-shrink: 0;
        }

        .donation-icon {
            background: #dcfce7;
        }

        .trending-icon {
            background: #fef3c7;
        }

        .stat-card,
        .panel,
        .welcome-card {
            transition: all 0.2s ease;
        }

        .stat-card:hover,
        .panel:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 24px rgba(15, 23, 42, 0.06);
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
                <a href="dashboard_dn.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a>

                <div class="menu-section-gap"></div>

                <a href="search_dn_fra.php" class="<?= $activePage === 'browse_fra' ? 'active' : '' ?>">🔍 Browse FRA</a>
                <a href="view_dn_fav_fra.php" class="<?= $activePage === 'favourite_fra' ? 'active' : '' ?>">⭐ Saved FRA</a>

                <div class="menu-section-gap"></div>

                <div class="dropdown-menu">
                    <a href="javascript:void(0);" class="dropdown-btn" onclick="toggleDonationMenu()">
                        💰 My Donations ▼
                    </a>

                    <div id="donationDropdown" class="dropdown-content">

                        <a href="search_donate_history.php" class="submenu-link">
                            🧾 Donation History
                        </a>

                        <a href="view_donate_progress.php" class="submenu-link">
                            📈 View Progress
                        </a>

                    </div>
                </div>

            </nav>

        </aside>

        <main class="main">
            <header class="topbar">
                <h2>Dashboard</h2>

                <div class="topbar-right">
                    <div class="avatar-small">DN</div>
                    <button type="button" class="btn-logout" onclick="showLogout()">Logout</button>
                </div>
            </header>

            <section class="content">
                <?php if (!empty($contentView)) include $contentView; ?>
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

        function toggleDonationMenu() {

            document
                .getElementById('donationDropdown')
                .classList
                .toggle('show');
        }
    </script>

</body>

</html>