<?php
$totalViews = $totalViews ?? 0;
$mostViewedFRA = $mostViewedFRA ?? '-';
?>


<h1>View Statistics</h1>

<div class="stats-summary">
    <div class="stats-card">
        <strong>👁️ Total FRA Views:</strong>
        <?= htmlspecialchars((string)$totalViews) ?>
    </div>

    <div class="stats-card">
        <strong>⭐ Most Viewed FRA:</strong>
        <?= htmlspecialchars($mostViewedFRA) ?>
    </div>
</div>

<div class="view-fra-container">
    <table class="view-fra-table statistics-table">
        <thead>
            <tr>
                <th>Campaign</th>
                <th>Category</th>
                <th>Goal Amount</th>
                <th>End Date</th>
                <th>Views</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($fraList)): ?>
                <?php foreach ($fraList as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['campaign_title'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>
                        <td>$<?= number_format((float)($row['goal_amount'] ?? 0), 0) ?></td>
                        <td><?= date('d M Y', strtotime($row['end_date'])) ?></td>
                        <td>
                        <span class="view-badge">
                        <?= htmlspecialchars((string)($row['view_count'] ?? 0)) ?>
                        </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No FRA statistics found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>