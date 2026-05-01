<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="catAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('catAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

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
                        <button type="button" class="btn btn-outline"
                            onclick="openDeleteCatModal(<?= (int)$cat['id'] ?>, '<?= htmlspecialchars($cat['name'], ENT_QUOTES) ?>')">
                            Delete
                        </button>
                    </span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div id="deleteCatModal" class="modal">
    <div class="modal-card">
        <h3>⚠ Confirm Deletion</h3>
        <p id="deleteCatModalText"></p>

        <form method="POST" action="delete_cat.php">
            <input type="hidden" name="delete_id" id="delete_cat_id">
            <div class="modal-actions">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn" onclick="closeDeleteCatModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDeleteCatModal(id, name) {
        document.getElementById('delete_cat_id').value = id;
        document.getElementById('deleteCatModalText').innerText =
            'Are you sure you want to delete "' + name + '"?';
        document.getElementById('deleteCatModal').classList.add('open');
    }
    function closeDeleteCatModal() {
        document.getElementById('deleteCatModal').classList.remove('open');
    }

    const catAlert = document.getElementById('catAlert');
    if (catAlert) {
        setTimeout(() => { catAlert.style.display = 'none'; }, 3000);
    }
</script>
