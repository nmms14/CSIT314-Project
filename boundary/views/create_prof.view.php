<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="profAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('profAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Create User Profile</h1>

<form method="POST" class="form-card">
    <div class="form-group">
        <label>Profile Name</label>
        <input type="text" name="profile_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="5" class="form-control" required></textarea>
    </div>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Create</button>
        <a href="dashboard_ua.php" class="btn">Cancel</a>
    </div>
</form>

<script>
    const profAlert = document.getElementById('profAlert');
    if (profAlert) {
        setTimeout(() => {
            profAlert.style.display = 'none';
        }, 3000);
    }
</script>
