<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="accAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('accAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Account Update</h1>

<form method="POST" class="form-card">
	<input type="hidden" name="currUsername" value="<?= htmlspecialchars($user->username) ?>">
	
	<?php $isDisabled = ($user->status === 'suspended'); ?>
	
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter full name" value="<?= htmlspecialchars($user->name ?? '') ?>" 
			<?= $isDisabled ? 'disabled' : '' ?>>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?= htmlspecialchars($user->username ?? '') ?>"
			<?= $isDisabled ? 'disabled' : '' ?>>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?= htmlspecialchars($user->email ?? '') ?>"
			<?= $isDisabled ? 'disabled' : '' ?>>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter 8-digit phone number" value="<?= htmlspecialchars($user->phone ?? '') ?>"
			<?= $isDisabled ? 'disabled' : '' ?>>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password"
			<?= $isDisabled ? 'disabled' : '' ?>>
    </div>

	<label>Profile</label>
	<select name="profile" class="form-control" <?= $isDisabled ? 'disabled' : '' ?>>
		<option value="">Select a role..</option>

		<?php while ($row = $profiles->fetch_assoc()): ?>
			<option value="<?= $row['profile_name'] ?>"
				<?= (($user->profile ?? '') === $row['profile_name']) ? 'selected' : '' ?>>
				<?= $row['profile_name'] ?>
			</option>
		<?php endwhile; ?>
	</select>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn" <?= $isDisabled ? 'disabled' : '' ?>>Update</button>
        <a href="view_acc_detail.php?username=<?= urlencode($user->username) ?>" class="btn">
			Cancel
		</a>
    </div>
</form>
