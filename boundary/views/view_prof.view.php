<div class="header-top">
    <h1>User Profiles</h1>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search profile.." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">🔍</button>
    </form>
</div>

<div class="header-box">
    <div class="header-row prof-row">
        <span>Profile Name</span>
        <span>Description</span>
        <span>User Count</span>
        <span>Actions</span>
    </div>
</div>
<br>

<div class="body-box">
    <?php if (empty($profiles)): ?>
        <p style="padding:14px;">No user profiles found.</p>
    <?php else: ?>
        <?php foreach ($profiles as $p): ?>
            <div class="user-row">
                <div class="user-main prof-row">
                    <span><?= htmlspecialchars($p->profileName) ?></span>
                    <span><?= htmlspecialchars($p->description) ?></span>
                    <span><?= (int)$p->userCount ?></span>
                    <span>
                        <a class="btn" href="view_prof_detail.php?profile_id=<?= (int)$p->profileID ?>">View</a>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="create-container">
	<a href="create_prof.php" class="btn create-btn">
		+ Create New
	</a>
</div>
