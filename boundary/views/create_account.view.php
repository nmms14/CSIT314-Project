<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="accAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('accAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Create an Account</h1>

<form method="POST" class="form-card">
    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" placeholder="Enter full name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Username *</label>
        <input type="text" name="username" class="form-control" placeholder="Enter username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter 8-digit phone number" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Password *</label>
        <input type="password" name="password" class="form-control" placeholder="Min. 6 characters" required>
    </div>

    <div class="form-group">
        <label>Profile *</label>
        <select name="profile" class="form-control" required>
            <option value="">Select a role..</option>
            <option value="platform_manager" <?= (($_POST['profile'] ?? '') === 'platform_manager') ? 'selected' : '' ?>>Platform Manager</option>
            <option value="user_admin" <?= (($_POST['profile'] ?? '') === 'user_admin') ? 'selected' : '' ?>>User Admin</option>
            <option value="fund_raiser" <?= (($_POST['profile'] ?? '') === 'fund_raiser') ? 'selected' : '' ?>>Fund Raiser</option>
            <option value="donee" <?= (($_POST['profile'] ?? '') === 'donee') ? 'selected' : '' ?>>Donee</option>
        </select>
    </div>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Create</button>
        <a href="dashboard_ua.php" class="btn">Cancel</a>
    </div>
</form>