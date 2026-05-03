<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="catAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('catAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>FRA Category View</h1>

<div class="category-container">

    <div class="category-header">
        <span>Name</span>
        <span>Description</span>
        <span>FRA Count</span>
    </div>

    <div class="category-body">

        <?php if (empty($categories)): ?>
            <p class="no-data">No categories found.</p>
        <?php else: ?>

            <?php foreach ($categories as $cat): ?>
                <div class="category-row">

                    <span><?= htmlspecialchars($cat['name']) ?></span>

                    <span><?= htmlspecialchars($cat['description']) ?></span>

                    <span><?= htmlspecialchars($cat['fra_count']) ?></span>

                </div>
            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>