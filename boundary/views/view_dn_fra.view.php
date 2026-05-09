<?php if (!empty($popupMessage)): ?>

    <div class="alert-popup
         <?= $popupType ?>">

        <?= htmlspecialchars($popupMessage) ?>

    </div>

<?php endif; ?>

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
		<button class="back-btn" onclick="openDonateModal()">
			Donate
		</button>

		<div id="donatePopup" style="display:none;">

			<form method="POST">

				<input type="number"
					   name="amount"
					   placeholder="Enter amount"
					   min="1"
					   step="0.01"
					   required>

				<button type="submit">
					Confirm Donation
				</button>

			</form>

		</div>
		
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

<div id="donateModal" class="modal">
    <div class="modal-card">

        <h3>FRA Donation</h3>

        <form method="POST">
            <input type="number" name="amount" placeholder="Enter donation amount" min="1" step="0.01" 
					required style="width:100%; padding:10px; margin-top:15px;">

            <div class="modal-actions">
                <button type="button"
                        class="btn"
                        onclick="closeDonateModal()">
                    Cancel
                </button>

                <button type="submit"
                        class="back-btn">
                    Confirm
                </button>
            </div>
        </form>
    </div>
</div>

<script>
	function openDonateModal() {
		document.getElementById('donateModal')
				.classList.add('open');
	}

	function closeDonateModal() {
		document.getElementById('donateModal')
				.classList.remove('open');
	}
</script>