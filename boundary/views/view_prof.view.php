<?php if (isset($_GET['success'])): ?>
    <div class="alert-popup success" id="profSuccessAlert">
        Profile updated successfully!
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('profSuccessAlert');
            if (el) el.style.display = 'none';
        }, 3000);
    </script>
<?php endif; ?>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert-popup <?= htmlspecialchars($_GET['type'] ?? 'success') ?>" id="profMsgAlert">
        <span><?= htmlspecialchars($_GET['msg']) ?></span>
        <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('profMsgAlert');
            if (el) el.style.display = 'none';
        }, 3000);
    </script>
<?php endif; ?>

<div class="header-top">

  <div>
    <?php if (!empty($_GET['keywords'])): ?>
      <h1>Result for "<?= htmlspecialchars($_GET['keywords']) ?>"</h1>

      <?php if (!empty($profiles)): ?>
        <p><?= count($profiles) ?> matches found</p>
      <?php else: ?>
        <p>No results found</p>
      <?php endif; ?>

    <?php else: ?>
      <h1>User Profiles</h1>
    <?php endif; ?>
  </div>

	<div class="search-fra-toolbar">
		<form method="GET" class="search-fra-form">
			<div class="search-input-wrapper">
				<input
					type="text"
					name="keywords"
					class="search-fra-input"
					placeholder="Search profiles..."
					value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>"
				>

				<?php if (!empty($_GET['keywords'])): ?>

					<a href="view_prof.php"
					   class="search-clear-btn">

						&times;

					</a>
				<?php endif; ?>
			</div>

			<button type="submit" class="search-fra-btn">
				Search
			</button>
		</form>
	</div>
</div>

<div class="header-box">
    <div class="header-row prof-row">
        <span>Profile Name</span>
        <span>Description</span>
        <span>User Count</span>
        <span>Status</span>
        <span>Actions</span>
    </div>
</div>
<br>

<div class="body-box">
	<div class="profile-list">
		<?php if (empty($profiles)): ?>
			<p style="padding:14px;">No user profiles found.</p>
		<?php else: ?>
			<?php foreach ($profiles as $p): ?>
				<div class="user-row">
					<div class="user-main prof-row">
						<span><?= htmlspecialchars($p['profile_name']) ?></span>
						<span><?= htmlspecialchars($p['description']) ?></span>
						<span><?= (int)$p['user_count'] ?></span>
						<span class="<?= strtolower($p['status'] ?? 'active') === 'active' ? 'status-active' : 'status-suspended' ?>">
							<?= htmlspecialchars($p['status'] ?? 'Active') ?>
						</span>
						<span>
							<a class="btn" href="update_prof.php?profile_id=<?= (int)$p['profile_id'] ?>&profile_name=<?= urlencode($p['profile_name']) ?>&description=<?= urlencode($p['description']) ?>">Edit</a>
							<?php if (($p['status'] ?? 'Active') !== 'Suspended'): ?>
								<button type="button" class="btn"
									onclick="openSuspendModal(<?= (int)$p['profile_id'] ?>, '<?= htmlspecialchars($p['profile_name'], ENT_QUOTES) ?>')">
									Suspend
								</button>
							<?php else: ?>
								<button type="button" class="btn" disabled style="opacity:0.5; cursor:not-allowed;">
									Suspended
								</button>
							<?php endif; ?>
						</span>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>

<div class="create-container">
    <a href="create_prof.php" class="btn create-btn">
        + Create New
    </a>
</div>

<div id="suspendModal" class="modal">
    <div class="modal-card">
        <h3>Confirm Suspension</h3>
        <p id="suspendModalText"></p>

        <form method="POST" action="view_prof_detail.php">
            <input type="hidden" name="profile_id" id="suspend_profile_id">
            <input type="hidden" name="action" value="suspend">
            <div class="modal-actions">
                <button type="submit" class="btn btn-danger">Suspend</button>
                <button type="button" class="btn" onclick="closeSuspendModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openSuspendModal(id, name) {
        document.getElementById('suspend_profile_id').value = id;
        document.getElementById('suspendModalText').innerText =
            'Are you sure you want to suspend "' + name + '"?';
        document.getElementById('suspendModal').classList.add('open');
    }
    function closeSuspendModal() {
        document.getElementById('suspendModal').classList.remove('open');
    }
</script>