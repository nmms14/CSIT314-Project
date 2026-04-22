<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="accAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('accAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Account Update</h1>

<form method="POST" class="form-card">
	<input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">
	
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter full name" value="<?= htmlspecialchars($user->name ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Enter username" value="<?= htmlspecialchars($user->username ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" value="<?= htmlspecialchars($user->email ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter 8-digit phone number" value="<?= htmlspecialchars($user->phone ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
    </div>

    <?php
		$controller = new updateAccController();
		$profiles = $controller->loadProfiles();
	?>

	<label>Profile</label>
	<select name="profile" class="form-control">
		<option value="">Select a role..</option>

		<?php while ($row = $profiles->fetch_assoc()): ?>
			<option value="<?= strtolower(str_replace(' ', '_', $row['profile_name'])) ?>"
				<?= (($user->profile ?? '') === strtolower(str_replace(' ', '_', $row['profile_name']))) ? 'selected' : '' ?>>
				<?= $row['profile_name'] ?>
			</option>
		<?php endwhile; ?>
	</select>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Update</button>
        <a href="dashboard_ua.php" class="btn">Cancel</a>
    </div>
</form>
