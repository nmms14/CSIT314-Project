<h1>FRA View</h1>

<div class="table-wrap">
    <table class="fra-table">
        <thead>
            <tr>
                <th>Campaign Title</th>
                <th>Category</th>
                <th>Amount</th>
                <th>End Date</th>
                <th class="desc-header">Description</th>
                <th>Donee</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fraList)): ?>
                <?php foreach ($fraList as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['campaign_title'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>
                        <td>$<?= number_format((float)($row['goal_amount'] ?? 0), 0) ?></td>
                        <td><?= date('Y/m/d', strtotime($row['end_date'])) ?></td>
                        <td><?= htmlspecialchars($row['description'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['donee_name'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['phone'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;">No campaigns found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>