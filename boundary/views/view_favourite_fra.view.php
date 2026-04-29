<?php
$searchKeyword = $searchKeyword ?? '';
$results = $results ?? [];
?>

<div class="search-header">
    <div>
        <h1>Favourite FRA</h1>
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
            </div>

            <button type="submit" class="search-fra-btn">Search</button>
        </form>
    </div>
</div>

<div class="table-wrap">
	<table class="table-base search-fra-table">
		<thead>
			<tr>
				<th>Donee</th>
				<th>Campaign</th>
				<th>Category</th>
				<th>Amount</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($activities as $fra): ?>
				<tr>
					<td><?= htmlspecialchars($fra['donee_name'] ?? '') ?></td>
					<td><?= htmlspecialchars($fra['campaign_title'] ?? '') ?></td>
					<td><?= htmlspecialchars($fra['category'] ?? '') ?></td>
					<td>$<?= number_format((float)($fra['goal_amount'] ?? 0), 0) ?></td>
					<td>
						<a href="view_dn_fra.php?id=<?= htmlspecialchars($fra['id']) ?>&source=fav" class="view-btn">View</a>

						<button class="save-btn" disabled>Saved</button>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>