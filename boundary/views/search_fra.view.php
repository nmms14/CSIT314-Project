<?php if (!empty($popupMessage)): ?>
    <div id="fraAlert" class="alert-popup <?= htmlspecialchars($popupType) ?>">
        <span><?= htmlspecialchars($popupMessage) ?></span>
        <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
<?php endif; ?>

<h1>FRA Search</h1>

<div class="search-fra-toolbar">
    <form method="GET" action="search_fra.php" class="search-fra-form">

        <div class="search-input-wrapper">
            <input
                type="text"
                name="keyword"
                class="search-fra-input"
                placeholder="Enter details"
                value="<?= htmlspecialchars($searchKeyword) ?>"
            >

            <?php if ($searchKeyword !== ''): ?>
                <a href="search_fra.php" class="search-clear-btn">
                    &times;
                </a>
            <?php endif; ?>
        </div>

        <button type="submit" class="search-fra-btn">
            Search
        </button>

    </form>
</div>

<div class="table-wrap">
    <table class="table-base search-fra-table">
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
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $fra): ?>
                    <tr>
                        <td><?= htmlspecialchars($fra['campaign_title']) ?></td>
                        <td><?= htmlspecialchars($fra['category']) ?></td>
                        <td>$<?= number_format((float)$fra['goal_amount'], 0) ?></td>
                        <td><?= htmlspecialchars(date('Y/m/d', strtotime($fra['end_date']))) ?></td>
                        <td><?= htmlspecialchars($fra['description']) ?></td>
                        <td><?= htmlspecialchars($fra['donee_name']) ?></td>
                        <td><?= htmlspecialchars($fra['phone']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php elseif ($searchKeyword !== ''): ?>
                <tr>
                    <td colspan="7">No FRA matches your search.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="7">Enter a keyword to search fundraising activities.</td>
                </tr>
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