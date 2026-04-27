<div class="back-container">
    <a href="view_acc.php" class="back-btn">←</a>
</div>

<?php if (isset($_GET['success'])): ?>
    <div class="alert-popup success">
        Account updated successfully!
    </div>
<?php endif; ?>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert-popup <?= htmlspecialchars($_GET['type']) ?>">
        <span><?= htmlspecialchars($_GET['msg']) ?></span>
        <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
    </div>
<?php endif; ?>


<div class="details-content">
    <!-- LEFT SIDE -->
    <div class="left-panel">

        <div class="avatar-large">
            <?= strtoupper(substr($user->username ?? 'U', 0, 1)) ?>
        </div>

        <p class="username"><?= htmlspecialchars($user->username) ?></p>
        <p class="status">Status: <?= htmlspecialchars($user->status) ?></p>

        <div class="action-buttons">
            <?php if ($user->status !== 'Suspended'): ?>
				<a href="update_acc.php?username=<?= urlencode($user->username) ?>" class="btn btn-link-button">
					Update
				</a>
			<?php else: ?>
				<a class="btn btn-link-button" style="pointer-events:none; opacity:0.5;">
					Update
				</a>
			<?php endif; ?>

            <form method="POST" action="view_acc_detail.php">
                <input type="hidden" name="username" value="<?= htmlspecialchars($user->username) ?>">
				<?php if ($user->status !== 'Suspended'): ?>
					<button type="button" class="btn" onclick="openSuspendModal()">
						Suspend
					</button>
				<?php else: ?>
					<button type="button" class="btn" disabled style="opacity:0.5; cursor:not-allowed;">
						Suspended
					</button>
				<?php endif; ?>
            </form>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="form-box">
        <form method="POST">
			<div class="form-group">
				<label>Name</label>
				<input type="text"
					   name="name"
					   value="<?= htmlspecialchars($user->name ?? '') ?>"
					   readonly>
			</div>
			
			<div class="form-group">
				<label>Username</label>
				<input type="text"
					   name="username"
					   value="<?= htmlspecialchars($user->username ?? '') ?>"
					   readonly>
			</div>
			
			<div class="form-group">
				<label>Email</label>
				<input type="email"
					   name="email"
					   value="<?= htmlspecialchars($user->email ?? '') ?>"
					   readonly>
			</div>
			
			<div class="form-group">
				<label>Phone Number</label>
				<input type="text"
					   name="phone"
					   value="<?= htmlspecialchars($user->phone ?? '') ?>"
					   readonly>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password"
					   name="password"
					   value="<?= htmlspecialchars($user->password ?? '********') ?>"
					   readonly>
			</div>

			<div class="form-group">
				<label>Profile</label>
				<input type="text"
					   name="profile"
					   value="<?= htmlspecialchars($user->profile ?? '') ?>"
					   readonly>
			</div>

		</form>
    </div>
	
	<div id="suspendModal" class="modal">
		<div class="modal-card">
			<h3>Confirm Suspension</h3>
			<p>Are you sure you want to suspend this account?</p>

			<form method="POST" action="view_acc_detail.php">
				<input type="hidden" name="username" value="<?= htmlspecialchars($user->username) ?>">
				<input type="hidden" name="action" value="suspend">
				<div class="modal-actions">
					<button type="submit" class="btn btn-danger">Suspend</button>
					<button type="button" class="btn" onclick="closeSuspendModal()">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function openSuspendModal() {
		document.getElementById('suspendModal').classList.add('open');
	}

	function closeSuspendModal() {
		document.getElementById('suspendModal').classList.remove('open');
	}
</script>