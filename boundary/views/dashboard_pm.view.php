<?php
$dailyReport   = $dailyReport   ?? null;
$weeklyReport  = $weeklyReport  ?? null;
$monthlyReport = $monthlyReport ?? null;

$today      = $today      ?? date('Y-m-d');
$weekStart  = $weekStart  ?? date('Y-m-d', strtotime('monday this week'));
$weekEnd    = $weekEnd    ?? date('Y-m-d', strtotime($weekStart . ' +6 days'));
$monthString = $monthString ?? date('Y-m');

$summaryPanels = [
    [
        'label'      => 'Today',
        'period'     => date('d M Y', strtotime($today)),
        'kpis'       => $dailyReport['kpis']    ?? [],
        'activities' => count($dailyReport['recent_activities']   ?? []),
        'favourites' => count($dailyReport['recent_favourites']   ?? []),
        'href'       => 'daily_report.php',
        'cta'        => 'View Daily Report',
        'icon'       => '📅',
    ],
    [
        'label'      => 'This Week',
        'period'     => date('d M', strtotime($weekStart)) . ' – ' . date('d M Y', strtotime($weekEnd)),
        'kpis'       => $weeklyReport['kpis']   ?? [],
        'activities' => count($weeklyReport['recent_activities']  ?? []),
        'favourites' => count($weeklyReport['recent_favourites']  ?? []),
        'href'       => 'weekly_report.php',
        'cta'        => 'View Weekly Report',
        'icon'       => '📆',
    ],
    [
        'label'      => 'This Month',
        'period'     => date('F Y', strtotime($monthString . '-01')),
        'kpis'       => $monthlyReport['kpis']  ?? [],
        'activities' => count($monthlyReport['recent_activities'] ?? []),
        'favourites' => count($monthlyReport['recent_favourites'] ?? []),
        'href'       => 'monthly_report.php',
        'cta'        => 'View Monthly Report',
        'icon'       => '🗓️',
    ],
];
?>

<style>
    .pm-welcome {
        background: #fff;
        padding: 28px;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        margin-bottom: 28px;
    }

    .pm-welcome h1 {
        margin: 0 0 8px;
        font-size: 32px;
    }

    .pm-welcome p {
        margin: 0;
        color: #64748b;
    }

    .pm-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }

    .pm-summary-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .pm-summary-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pm-summary-head h3 {
        margin: 0;
        font-size: 1.05rem;
        color: #111827;
    }

    .pm-summary-head .period {
        color: #64748b;
        font-size: 0.85rem;
        margin-top: 4px;
    }

    .pm-summary-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .pm-kpi-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .pm-kpi {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 12px 14px;
    }

    .pm-kpi .pm-kpi-label {
        color: #64748b;
        font-size: 0.78rem;
        margin-bottom: 4px;
    }

    .pm-kpi .pm-kpi-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #111827;
    }

    .pm-summary-footer {
        margin-top: auto;
    }

    .pm-summary-footer a {
        display: inline-block;
        padding: 10px 14px;
        border-radius: 10px;
        background: #2563eb;
        color: #fff;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9rem;
        transition: background 0.2s ease;
    }

    .pm-summary-footer a:hover {
        background: #1d4ed8;
    }

    @media (max-width: 1100px) {
        .pm-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="pm-welcome">
    <h1>Welcome back, <?= htmlspecialchars($_SESSION['username'] ?? 'Platform Manager') ?>!</h1>
    <p>A snapshot of platform activity across today, this week, and this month.</p>
</section>

<section class="pm-summary-grid">
    <?php foreach ($summaryPanels as $panel): ?>
        <?php $kpis = $panel['kpis']; ?>
        <article class="pm-summary-card">
            <div class="pm-summary-head">
                <div>
                    <h3><?= htmlspecialchars($panel['label']) ?></h3>
                    <div class="period"><?= htmlspecialchars($panel['period']) ?></div>
                </div>
                <div class="pm-summary-icon"><?= $panel['icon'] ?></div>
            </div>

            <div class="pm-kpi-list">
                <div class="pm-kpi">
                    <div class="pm-kpi-label">New Users</div>
                    <div class="pm-kpi-value"><?= (int) ($kpis['new_users'] ?? 0) ?></div>
                </div>
                <div class="pm-kpi">
                    <div class="pm-kpi-label">New FRAs</div>
                    <div class="pm-kpi-value"><?= (int) ($kpis['new_fra'] ?? 0) ?></div>
                </div>
                <div class="pm-kpi">
                    <div class="pm-kpi-label">New Favourites</div>
                    <div class="pm-kpi-value"><?= (int) ($kpis['new_favourites'] ?? 0) ?></div>
                </div>
                <div class="pm-kpi">
                    <div class="pm-kpi-label">FRAs Logged</div>
                    <div class="pm-kpi-value"><?= (int) $panel['activities'] ?></div>
                </div>
            </div>

            <div class="pm-summary-footer">
                <a href="<?= htmlspecialchars($panel['href']) ?>"><?= htmlspecialchars($panel['cta']) ?> →</a>
            </div>
        </article>
    <?php endforeach; ?>
</section>
