<?php
$results = $results ?? [];
?>

<div class="completed-header">

    <div>

        <?php if (!empty($_GET['keyword'])): ?>

            <h1>
                Result for "<?= htmlspecialchars($_GET['keyword']) ?>"
            </h1>

            <p style="color:#6b7280;">
                <?= count($results) ?> match found
            </p>

        <?php else: ?>

            <h1>View Completed FRA</h1>

        <?php endif; ?>

    </div>

    <div class="completed-search-toolbar">

        <form method="GET"
              action="view_completed_fra.php"
              class="search-fra-form">

            <div class="search-input-wrapper">

                <input
                    type="text"
                    name="keyword"
                    class="search-fra-input"
                    placeholder="Enter keywords"
                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>"
                >

                <?php if (!empty($_GET['keyword'])): ?>
                    <a href="view_completed_fra.php"
                       class="search-clear-btn">
                        ×
                    </a>
                <?php endif; ?>

            </div>

            <button type="submit" class="search-fra-btn">
                Search
            </button>

        </form>

    </div>

</div>

<?php if (!empty($results)): ?>

    <div class="view-fra-container">

        <table class="view-fra-table statistics-table">

            <thead>
                <tr>
                    <th>Fundraiser</th>
                    <th>Campaign</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($results as $row): ?>

                    <tr>
                        <td><?= htmlspecialchars($row['fundraiser_name'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['campaign_title'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['category'] ?? '-') ?></td>
                        <td>$<?= number_format((float)($row['goal_amount'] ?? 0), 0) ?></td>
                        <td>Completed</td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

<?php else: ?>

    <?php if (!empty($_GET['keyword'])): ?>

        <p style="text-align:center; margin-top: 40px;">
            No details match your search!
        </p>

    <?php else: ?>

        <div class="view-fra-container">

            <table class="view-fra-table statistics-table">

                <tbody>

                    <tr>
                        <td colspan="5"
                            style="text-align:center; padding: 40px 20px;">
                            No completed FRA found.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

<?php endif; ?>