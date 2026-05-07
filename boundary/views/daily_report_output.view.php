<?php
$report = $report ?? null;
$dayString = $dayString ?? '';

if (!$report) return;

$meta = $report['meta'];
$kpis = $report['kpis'];
$categories = $report['category_breakdown'];
$activities = $report['recent_activities'];
$favourites = $report['recent_favourites'];
?>

<style>
    .report-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    .report-header h1 { margin: 0; font-size: 1.8rem; }
    .report-meta {
        text-align: right;
        font-size: 0.85rem;
        color: #6b7280;
    }
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }
    .kpi-card {
        border: 1px solid #d1d5db;
        border-radius: 12px;
        padding: 18px;
        background: #f9fafb;
    }
    .kpi-card .label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 8px;
    }
    .kpi-card .value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #111827;
    }
    .report-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 24px;
    }
    .report-block h3 {
        margin: 0 0 10px;
        font-size: 1rem;
    }
    .report-block table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }
    .report-block th, .report-block td {
        border: 1px solid #d1d5db;
        padding: 10px;
        text-align: left;
        font-size: 0.9rem;
    }
    .report-block th { background: #f3f4f6; }
    .empty-row td {
        text-align: center;
        color: #6b7280;
    }
    .report-actions {
        margin-top: 18px;
    }
</style>

<div class="report-header">
    <div>
        <h1>Daily Report</h1>
        <p style="margin:6px 0 0;color:#374151;">For <?= htmlspecialchars(date('d M Y', strtotime($meta['day']))) ?></p>
    </div>
    <div class="report-meta">
        Generated on : <?= htmlspecialchars($meta['generated_at']) ?><br>
        Report ID : <?= htmlspecialchars($meta['report_id']) ?>
    </div>
</div>

<div class="kpi-grid">
    <div class="kpi-card"><div class="label">New Users</div><div class="value"><?= (int) $kpis['new_users'] ?></div></div>
    <div class="kpi-card"><div class="label">New Fundraising Activities</div><div class="value"><?= (int) $kpis['new_fra'] ?></div></div>
    <div class="kpi-card"><div class="label">Favourite Fundraising Added</div><div class="value"><?= (int) $kpis['new_favourites'] ?></div></div>
    <div class="kpi-card"><div class="label">Total Users</div><div class="value"><?= (int) $kpis['total_users'] ?></div></div>
    <div class="kpi-card"><div class="label">Total Fundraising Activities</div><div class="value"><?= (int) $kpis['total_fra'] ?></div></div>
    <div class="kpi-card"><div class="label">Total Favourite Fundraising Added</div><div class="value"><?= (int) $kpis['total_favourites'] ?></div></div>
</div>

<div class="report-row">
    <div class="report-block">
        <h3>Category Breakdown</h3>
        <table>
            <thead>
                <tr><th>Category</th><th>Total Activities</th></tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr class="empty-row"><td colspan="2">No data</td></tr>
                <?php else: foreach ($categories as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= (int) $row['total'] ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <div class="report-block">
        <h3>Recent Activities</h3>
        <table>
            <thead>
                <tr><th>Title</th><th>Category</th><th>Created at</th></tr>
            </thead>
            <tbody>
                <?php if (empty($activities)): ?>
                    <tr class="empty-row"><td colspan="3">No activities created on this date</td></tr>
                <?php else: foreach ($activities as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['campaign_title']) ?></td>
                        <td><?= htmlspecialchars($a['category']) ?></td>
                        <td><?= htmlspecialchars(date('d M Y, g:ia', strtotime($a['created_at']))) ?></td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="report-block">
    <h3>Recent Favourites</h3>
    <table>
        <thead>
            <tr><th>Username</th><th>Activity Title</th><th>Category</th><th>Added at</th></tr>
        </thead>
        <tbody>
            <?php if (empty($favourites)): ?>
                <tr class="empty-row"><td colspan="4">No favourites added on this date</td></tr>
            <?php else: foreach ($favourites as $f): ?>
                <tr>
                    <td><?= htmlspecialchars($f['username']) ?></td>
                    <td><?= htmlspecialchars($f['campaign_title']) ?></td>
                    <td><?= htmlspecialchars($f['category']) ?></td>
                    <td><?= htmlspecialchars(date('d M Y, g:ia', strtotime($f['created_at']))) ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>

<div class="report-actions">
    <a href="daily_report.php" class="btn">Generate another report</a>
</div>
