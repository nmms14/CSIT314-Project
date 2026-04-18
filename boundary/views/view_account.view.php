<div class="header-top">
    <h1>User Accounts</h1>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search users...">
        <button type="submit">🔍</button>
    </form>
</div>

<div class="header-box">
    <div class="header-row">
        <span>Username</span>
        <span>Email</span>
        <span>Profile</span>
        <span>Status</span>
    </div>
</div>
<br>

<div class="body-box">

    <?php if (empty($users)): ?>
        <p>No users found.</p>
    <?php else: ?>

        <div class="user-list">
            <?php foreach ($users as $user): ?>
                <div class="user-row">
                    <div class="user-main">
                        <span><?= htmlspecialchars($user->username) ?></span>
                        <span><?= htmlspecialchars($user->email) ?></span>
                        <span><?= htmlspecialchars($user->profile) ?></span>

                        <span class="<?= strtolower($user->status) === 'active' ? 'status-active' : 'status-suspended' ?>">
                            <?= htmlspecialchars($user->status) ?>
                        </span>
						
                    </div>
					<!-- Hover Card -->
					<div class="hover-card">
						<div class="card-content">

							<div class="avatar">
								<?= strtoupper(substr($user->username, 0, 1)) ?>
							</div>

							<p><strong><?= htmlspecialchars($user->username) ?></strong></p>

							<a class="btn"
							   href="view_acc_detail.php?username=<?= urlencode($user->username) ?>">
								View Details
							</a>

						</div>
					</div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
	
</div>

<div class="create-container">
	<a href="create_acc.php" class="btn create-btn">
		+ Create
	</a>
</div>