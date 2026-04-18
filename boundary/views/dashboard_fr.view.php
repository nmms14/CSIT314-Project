<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fund Raiser Dashboard</title>
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
            gap: 1.5rem;
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
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }

        .menu a {
            display: block;
            width: 100%;
            padding: .75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            text-decoration: none;
            color: #111827;
            background: #fff;
            font-size: .95rem;
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
            margin: 0 0 1rem;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .content p {
            color: #4b5563;
            font-size: .95rem;
        }

        .form-card {
            max-width: 900px;
            margin-top: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: .4rem;
        }

        .form-control {
            width: 100%;
            padding: .75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            font: inherit;
        }

        textarea.form-control {
            resize: vertical;
        }

        .money-input {
            display: flex;
            align-items: center;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .money-input span {
            padding: 0 .75rem;
            border-right: 1px solid #d1d5db;
            background: #fff;
        }

        .money-input input {
            flex: 1;
            padding: .75rem;
            border: none;
            outline: none;
            font: inherit;
        }

        .table-wrap {
            margin-top: 1.5rem;
            max-width: 1100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th, td {
            border: 1px solid #111;
            padding: .75rem;
            text-align: left;
        }

        th {
            font-weight: 700;
        }

        .pagination {
            text-align: center;
            margin-top: 1rem;
        }

        .page-link {
            display: inline-block;
            margin: 0 .25rem;
            padding: .35rem .7rem;
            text-decoration: none;
            color: #111827;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: #f9fafb;
            font-size: .95rem;
        }

        .page-link:hover {
            background: #e5e7eb;
        }

        .active-page {
            background: #e5e7eb;
            color: #111827;
            border-color: #d1d5db;
            font-weight: 600;
        }

        .alert-popup {
            max-width: 900px;
            margin-bottom: 1rem;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            border: 1px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            box-shadow: 0 6px 16px rgba(0,0,0,0.06);
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

        .alert-text {
            font-size: .95rem;
            font-weight: 500;
        }

        .alert-close {
            background: transparent;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            color: inherit;
            padding: 0;
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

        .modal.open {
            display: flex;
        }

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

            <nav class="menu">
                <a href="dashboard_fr.php?page=create_fra"
                   class="<?= ($page === 'create_fra') ? 'active' : '' ?>">
                   Create FRA
                </a>

                <a href="dashboard_fr.php?page=view_fra"
                   class="<?= ($page === 'view_fra') ? 'active' : '' ?>">
                   View FRA
                </a>
            </nav>
        </aside>

        <main class="main">
            <header class="topbar">
                <h2>
                    <a href="dashboard_fr.php" style="text-decoration: none; color: inherit;">
                        Dashboard
                    </a>
                </h2>

                <div class="actions">
                    <div class="avatar">FR</div>
                    <button class="btn" type="button" onclick="showLogout()">Logout</button>
                </div>
            </header>

            <section class="content">
                <?php if ($page === 'create_fra'): ?>

                    <?php if (!empty($message)): ?>
                        <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="fraAlert">
                            <div class="alert-text"><?= htmlspecialchars($message) ?></div>
                            <button type="button" class="alert-close" onclick="document.getElementById('fraAlert').style.display='none'">×</button>
                        </div>
                    <?php endif; ?>

                    <h1>FRA Creation</h1>

                    <form method="POST" action="" enctype="multipart/form-data" class="form-card">
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Campaign Title</label>
                                <input type="text" name="campaign_title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Education">Education</option>
                                    <option value="Social">Social</option>
                                    <option value="Disaster Relief">Disaster Relief</option>
                                    <option value="Animal Welfare">Animal Welfare</option>
                                    <option value="Community">Community</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Target Amount</label>
                                <div class="money-input">
                                    <span>$</span>
                                    <input
                                        type="text"
                                        name="target_amount"
                                        placeholder="Enter amount"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="5" class="form-control" required></textarea>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>Donee Name</label>
                                <input type="text" name="donee_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="Enter 8-digit phone number"
                                    pattern="[89][0-9]{7}"
                                    title="Phone number must be 8 digits and start with 8 or 9"
                                    maxlength="8"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,8)"
                                    required
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Upload Supporting Documents</label>

                            <input type="file" id="supporting_documents" name="supporting_documents[]" multiple
                                   style="display:none;" onchange="handleFiles(this)">

                            <button type="button" class="btn" onclick="document.getElementById('supporting_documents').click()">
                                Choose Files
                            </button>

                            <div id="fileList" style="margin-top: .75rem;"></div>

                            <small style="color:#6b7280;">
                                You may upload multiple supporting files and remove any before submission.
                            </small>
                        </div>

                        <div style="display:flex; gap:.75rem;">
                            <button type="submit" class="btn">Create FRA</button>
                            <a href="dashboard_fr.php" class="btn">Cancel</a>
                        </div>
                    </form>

                <?php elseif ($page === 'view_fra'): ?>

                    <h1>FRA View</h1>

                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Campaign</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                    <th>Donee</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['fra_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>
                                            <td>$<?= number_format((int)($row['goal_amount'] ?? 0)) ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['end_date'])) ?></td>
                                            <td><?= htmlspecialchars($row['description'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['donee_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['phone'] ?? '-') ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center;">No campaigns found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <?php if ($currentPage > 1): ?>
                                <a href="dashboard_fr.php?page=view_fra&p=<?= $currentPage - 1 ?>" class="page-link">&lt;&lt;</a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="dashboard_fr.php?page=view_fra&p=<?= $i ?>"
                                   class="page-link <?= ($i === $currentPage) ? 'active-page' : '' ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <a href="dashboard_fr.php?page=view_fra&p=<?= $currentPage + 1 ?>" class="page-link">Next &gt;&gt;</a>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>

                    <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
                    <p>Select an option from the sidebar to continue.</p>

                <?php endif; ?>
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

    <script>
        let selectedFiles = [];

        function handleFiles(input) {
            const newFiles = Array.from(input.files);

            newFiles.forEach(file => {
                const exists = selectedFiles.some(
                    f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified
                );

                if (!exists) {
                    selectedFiles.push(file);
                }
            });

            updateFileInput();
            renderFileList();
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updateFileInput();
            renderFileList();
        }

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            document.getElementById('supporting_documents').files = dataTransfer.files;
        }

        function renderFileList() {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            if (selectedFiles.length === 0) {
                fileList.innerHTML = '<p style="color:#6b7280; margin:0;">No files selected.</p>';
                return;
            }

            selectedFiles.forEach((file, index) => {
                const item = document.createElement('div');
                item.style.display = 'flex';
                item.style.justifyContent = 'space-between';
                item.style.alignItems = 'center';
                item.style.padding = '.65rem .85rem';
                item.style.marginBottom = '.5rem';
                item.style.border = '1px solid #d1d5db';
                item.style.borderRadius = '8px';
                item.style.background = '#fff';

                item.innerHTML = `
                    <span style="color:#111827; font-size:.95rem;">${file.name}</span>
                    <button type="button" class="btn" onclick="removeFile(${index})">Remove</button>
                `;

                fileList.appendChild(item);
            });
        }

        renderFileList();

        const fraAlert = document.getElementById('fraAlert');
        if (fraAlert) {
            setTimeout(() => {
                fraAlert.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>