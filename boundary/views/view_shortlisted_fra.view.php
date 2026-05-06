<?php
$totalShortlists = $totalShortlists ?? 0;
$mostShortlistedFRA = $mostShortlistedFRA ?? '-';
?>

<h1>View Shortlist</h1>

<div class="stats-summary">

    <div class="stats-card">
        <strong>🔖 Total Shortlists:</strong>
        <?= htmlspecialchars((string)$totalShortlists) ?>
    </div>

    <div class="stats-card">
        <strong>🔥 Most Shortlisted FRA:</strong>
        <?= htmlspecialchars($mostShortlistedFRA) ?>
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
                <th>Shortlists</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($fraList)): ?>

                <?php foreach ($fraList as $row): ?>

                    <tr>

                        <td><?= htmlspecialchars($row['campaign_title'] ?? '-') ?></td>

                        <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>

                        <td>
                            $<?= number_format((float)($row['goal_amount'] ?? 0), 0) ?>
                        </td>

                        <td>
                            <?= date('d M Y', strtotime($row['end_date'])) ?>
                        </td>

                        <td>
                            <span class="view-badge">
                                <?= htmlspecialchars((string)($row['shortlist_count'] ?? 0)) ?>
                            </span>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5" style="text-align:center;">
                        No shortlist statistics found.
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>