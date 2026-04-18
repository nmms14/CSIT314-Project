<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="profAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('profAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Create User Profile</h1>

<form method="POST" class="form-card">
    <div class="form-group">
        <label>Profile Name *</label>
        <select name="profile_name" class="form-control" required>
            <option value="">Select a profile..</option>
            <option value="platform_manager" <?= (($_POST['profile_name'] ?? '') === 'platform_manager') ? 'selected' : '' ?>>Platform Manager</option>
            <option value="user_admin"       <?= (($_POST['profile_name'] ?? '') === 'user_admin')       ? 'selected' : '' ?>>User Admin</option>
            <option value="fund_raiser"      <?= (($_POST['profile_name'] ?? '') === 'fund_raiser')      ? 'selected' : '' ?>>Fund Raiser</option>
            <option value="donee"            <?= (($_POST['profile_name'] ?? '') === 'donee')            ? 'selected' : '' ?>>Donee</option>
        </select>
    </div>

    <div class="form-group">
        <label>Description *</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Enter profile description" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
    </div>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Create</button>
        <a href="view_prof.php" class="btn">Cancel</a>
    </div>
</form>
