<div class="header-top">
    <div>
        <?php if (!empty($_GET['keywords'])): ?>
            <h1>Result for "<?= htmlspecialchars($_GET['keywords']) ?>"</h1>
            <?php if (!empty($users)): ?>
                <p><?= count($users) ?> matches found</p>
            <?php endif; ?>
        <?php else: ?>
            <h1>User Accounts</h1>
        <?php endif; ?>
    </div>

    <form method="GET" class="search-form">
    <div class="search-wrapper">
        <input type="text" name="keywords" id="searchInput" placeholder="Search users..." value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>">
        <?php if (!empty($_GET['keywords'])): ?>
            <span class="clear-btn" onclick="window.location.href='view_acc.php'">×</span>
        <?php endif; ?>
    </div>
    <button type="submit">🔍</button>
</form>
</div>

<?php if (!empty($users)): ?>
<div class="header-box">
    <div class="header-row">
        <span>Username</span>
        <span>Email</span>
        <span>Profile</span>
        <span>Status</span>
    </div>
</div>
<br>
<?php endif; ?>

<div class="body-box">

    <?php if (empty($users)): ?>
        <?php if (!empty($_GET['keywords'])): ?>
            <p style="padding: 12px;">No accounts match your search.</p>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
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
		+ Create New
	</a>
</div>
