<?php if (empty($fra)): ?>

    <h1>FRA Not Found</h1>
    <p>The selected fundraising activity does not exist.</p>

<?php else: ?>

    <h1>FRA View</h1>

    <div class="fra-detail-card">
    <h2><?= htmlspecialchars($fra['campaign_title'] ?? '') ?></h2>

    <div class="fra-detail-grid">
        <p><strong>Category:</strong> <?= htmlspecialchars($fra['category'] ?? '') ?></p>
        <p><strong>Goal Amount:</strong> $<?= number_format((float)($fra['goal_amount'] ?? 0), 0) ?></p>
        <p><strong>End Date:</strong> <?= !empty($fra['end_date']) ? htmlspecialchars(date('d F Y', strtotime($fra['end_date']))) : '' ?></p>
        <p><strong>Donee:</strong> <?= htmlspecialchars($fra['donee_name'] ?? '') ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($fra['phone'] ?? '') ?></p>
        <p><strong>Fundraiser:</strong> <?= htmlspecialchars($fra['fundraiser_name'] ?? '-') ?></p>
    </div>

    <div class="fra-description-box">
        <strong>Description:</strong>
        <p><?= nl2br(htmlspecialchars($fra['description'] ?? '')) ?></p>
    </div>

    <div class="fra-detail-actions">
		<?php
			$source = $_GET['source'] ?? 'browse';

			$backUrl = ($source === 'fav') 
				? 'view_dn_fav_fra.php' 
				: 'search_dn_fra.php';
		?>

		<a href="<?= $backUrl ?>" class="back-btn">Back</a>
    </div>
</div>

<?php endif; ?>