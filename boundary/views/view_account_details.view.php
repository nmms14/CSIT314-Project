<div class="back-container">
    <a href="view_acc.php" class="back-btn">←</a>
</div>

<div class="details-content">

    <!-- LEFT SIDE -->
    <div class="left-panel">

        <div class="avatar-large">
            <?= strtoupper(substr($user->username ?? 'U', 0, 1)) ?>
        </div>

        <p class="username"><?= htmlspecialchars($user->username) ?></p>
        <p class="status">Status: <?= htmlspecialchars($user->status) ?></p>

        <div class="action-buttons">
            <button class="btn">Edit</button>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <button type="submit" name="suspend" class="btn">
                    Suspend
                </button>
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

</div>