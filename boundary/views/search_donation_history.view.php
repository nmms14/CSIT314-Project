<?php
$searchKeyword = $searchKeyword ?? '';
$results = $results ?? [];
?>

<div class="search-header">
    <div>
        <?php if ($searchKeyword !== ''): ?>
            <h1>Result for "<?= htmlspecialchars($searchKeyword) ?>"</h1>

            <p>
                <?= count($results) ?>
                match<?= count($results) === 1 ? '' : 'es' ?>
                found
            </p>

        <?php else: ?>
            <h1>Donation History</h1>
        <?php endif; ?>
    </div>

    <div class="search-fra-toolbar">
        <form method="GET"
              action="search_donate_history.php"
              class="search-fra-form">

            <div class="search-input-wrapper">
                <input type="text" name="keyword" class="search-fra-input" placeholder="Enter keywords" value="<?= htmlspecialchars($searchKeyword) ?>" >

                <?php if ($searchKeyword !== ''): ?>
                    <a href="search_donate_history.php" class="search-clear-btn">
                        &times;
                    </a>
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
                <th>Amount Donated</th>
                <th>Donation Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($results as $donation): ?>

            <tr>
                <td>
                    <?= htmlspecialchars($donation['campaign_title']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($donation['category']) ?>
                </td>

                <td>
                    $<?= number_format((float)$donation['amount'], 2) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        date(
                            'd M Y',
                            strtotime($donation['donation_date'])
                        )
                    ) ?>
                </td>

                <td>
					<?php

					$totalDonation =
						$donation['total_donation'] ?? 0;

					$goalAmount =
						$donation['goal_amount'] ?? 0;

					$endDate =
						strtotime($donation['end_date']);

					if (
						$totalDonation >= $goalAmount ||
						time() > $endDate
					) {
						echo 'Completed';
					} else {
						echo 'Ongoing';
					}

					?>
				</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
	
</div>

<?php elseif ($searchKeyword !== ''): ?>

    <p class="no-result-message">
        No donation history found!
    </p>

<?php endif; ?>