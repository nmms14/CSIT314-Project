<?php $keywords = $_GET['keywords'] ?? ''; ?>

<h1>FRA Category Search</h1>

<div class="search-cat-toolbar">
    <form method="GET" action="search_cat.php" class="search-cat-form">
        <div class="search-cat-input-wrapper">
            <input
                type="text"
                name="keywords"
                class="search-cat-input"
                placeholder="Search FRA Category.."
                value="<?= htmlspecialchars($keywords) ?>"
            >
            <?php if ($keywords !== ''): ?>
                <a href="search_cat.php" class="search-cat-clear-btn">&times;</a>
            <?php endif; ?>
            <button type="submit" class="search-cat-icon-btn" aria-label="Search">🔍</button>
        </div>
    </form>
</div>

<div class="edit-category-container">
    <div class="edit-category-header search-cat-header">
        <span>Name</span>
        <span>Description</span>
        <span>FRA Count</span>
    </div>

    <div class="edit-category-body">
        <?php if (empty($categories)): ?>
            <p class="no-data">
                <?= $keywords !== '' ? 'No categories match your search.' : 'No categories found.' ?>
            </p>
        <?php else: ?>
            <?php foreach ($categories as $cat): ?>
                <div class="edit-category-row search-cat-row">
                    <span><?= htmlspecialchars($cat['name']) ?></span>
                    <span><?= htmlspecialchars($cat['description']) ?></span>
                    <span><?= htmlspecialchars($cat['fra_count']) ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .search-cat-toolbar { margin: 16px 0; }
    .search-cat-form { width: 100%; }
    .search-cat-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    .search-cat-input {
        flex: 1;
        padding: 12px 80px 12px 14px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 14px;
    }
    .search-cat-input:focus { outline: none; border-color: #6b21a8; }
    .search-cat-clear-btn {
        position: absolute;
        right: 50px;
        text-decoration: none;
        color: #6b7280;
        font-size: 18px;
        padding: 0 6px;
    }
    .search-cat-icon-btn {
        position: absolute;
        right: 8px;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 4px 8px;
    }
    .search-cat-header,
    .search-cat-row {
        grid-template-columns: 1fr 2fr 1fr !important;
    }
</style>
