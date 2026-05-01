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

  <form method="GET" class="search-form">
    <div class="search-wrapper">
      <input type="text" name="keywords" id="searchInput"
        placeholder="Search profiles..."
        value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>">

      <?php if (!empty($_GET['keywords'])): ?>
        <a href="view_prof.php" class="clear-btn">×</a>
      <?php endif; ?>
    </div>

    <button type="submit">🔍</button>
  </form>
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