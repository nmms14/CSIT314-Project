<?php
$searchKeyword = $searchKeyword ?? '';
$results = $results ?? [];
?>
<?php if (!empty($popupMessage)): ?>
    <div id="fraAlert" class="alert-popup <?= htmlspecialchars($popupType ?? '') ?>">
        <span><?= htmlspecialchars($popupMessage) ?></span>
        <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
<?php endif; ?>

<div class="search-header">
    <div>
        <?php if ($searchKeyword !== ''): ?>
            <h1>Result for "<?= htmlspecialchars($searchKeyword) ?>"</h1>
            <p><?= count($results) ?> match<?= count($results) === 1 ? '' : 'es' ?> found</p>
        <?php else: ?>
            <h1>FRA Search</h1>
        <?php endif; ?>
    </div>

    <div class="search-fra-toolbar">
        <form method="GET" action="search_dn_fra.php" class="search-fra-form">
            <div class="search-input-wrapper">
                <input
                    type="text"
                    name="keyword"
                    class="search-fra-input"
                    placeholder="Enter details"
                    value="<?= htmlspecialchars($searchKeyword) ?>"
                >

                <?php if ($searchKeyword !== ''): ?>
                    <a href="search_dn_fra.php" class="search-clear-btn">&times;</a>
                <?php endif; ?>
            </div>

            <button type="submit" class="search-fra-btn">Search</button>
        </form>
    </div>
</div>

<?php if (!empty($results)): ?>
<div class="table-wrap">
    <table class="table-base search-fra-table">
        <thead>
            <tr>
                <th>Campaign</th>
                <th>Category</th>
                <th>Amount</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($results as $fra): ?>
                <tr>
                    <td><?= htmlspecialchars($fra['campaign_title'] ?? '') ?></td>
                    <td><?= htmlspecialchars($fra['category'] ?? '') ?></td>
                    <td>$<?= number_format((float)($fra['goal_amount'] ?? 0), 0) ?></td>
                    <td>
                            <?= !empty($fra['end_date'])
                                ? htmlspecialchars(date('d M Y', strtotime($fra['end_date'])))
                                : ''
                            ?>
                        </td>
                    <td>
    <a href="view_dn_fra.php?id=<?= htmlspecialchars($fra['id']) ?>&source=browse" class="view-btn">View</a>

    <a href="save_dn_fra.php?id=<?= htmlspecialchars($fra['id']) ?>" class="save-btn">Save</a>
</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php elseif ($searchKeyword !== ''): ?>

    <p class="no-result-message">
        No details match your search!
    </p>

<?php endif; ?>
        </tbody>
    </table>
</div>

<script>
const fraAlert = document.getElementById('fraAlert');

if (fraAlert) {
    setTimeout(() => {
        fraAlert.style.display = 'none';
    }, 3000);
}
</script>