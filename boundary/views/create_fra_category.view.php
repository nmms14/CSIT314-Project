<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="catAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('catAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>Create FRA Category</h1>

<form method="POST" class="form-card">
    <div class="form-group">
        <label>Category Name *</label>
        <input type="text" name="name" class="form-control" placeholder="Enter category name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control" placeholder="Enter category description" rows="4"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
    </div>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Create</button>
        <a href="dashboard_pm.php" class="btn">Cancel</a>
    </div>
</form>