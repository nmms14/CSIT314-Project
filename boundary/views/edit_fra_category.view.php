<?php
$editMode = isset($_GET['edit']);
$editName = $_GET['edit'] ?? '';
?>

<?php if (!$editMode): ?>
<h1>FRA Category View</h1>

<div class="edit-category-container">

    <div class="edit-category-header">
        <span>Name</span>
        <span>Description</span>
        <span>FRA Count</span>
		<span>Action</span>
    </div>

    <div class="edit-category-body">

        <?php if (empty($categories)): ?>
            <p class="no-data">No categories found.</p>
        <?php else: ?>

            <?php foreach ($categories as $cat): ?>
                <div class="edit-category-row">

                    <span><?= htmlspecialchars($cat['name']) ?></span>

                    <span><?= htmlspecialchars($cat['description']) ?></span>

                    <span><?= htmlspecialchars($cat['fra_count']) ?></span>
					
					<span>
						<a href="?edit=<?= urlencode($cat['name']) ?>" class="btn">Edit</a>
					</span>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>
<?php endif; ?>

<?php if ($editMode): ?>

	<?php if (!empty($message)): ?>
		<div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="catAlert">
			<div><?= htmlspecialchars($message) ?></div>
			<button type="button" class="alert-close" onclick="document.getElementById('catAlert').style.display='none'">×</button>
		</div>
	<?php endif; ?>

	<div id="editFormContainer">
		<h1>FRA Category Edit</h1>

		<form method="POST" class="form-card">
			<input type="hidden" name="old_name" value="<?= htmlspecialchars($editName) ?>">

			<div class="form-group">
				<label>Category Name *</label>
				<input type="text" name="name" id="edit_name" class="form-control" placeholder="Leave blank to keep current name">
			</div>

			<div class="form-group">
				<label>Description</label>
				<textarea name="description" id="edit_description" class="form-control" rows="4" placeholder="Leave blank to keep current name"></textarea>
			</div>

			<div style="display:flex; gap:12px;">
				<button type="submit" class="btn">Update</button>
				<a href="edit_cat.php" class="btn">Cancel</a>
			</div>
		</form>
	</div>
<?php endif; ?>