<?php if (!empty($popupMessage)): ?>
    <div id="fraAlert" class="alert-popup <?= htmlspecialchars($popupType ?? '') ?>">
        <span><?= htmlspecialchars($popupMessage) ?></span>

        <button
            type="button"
            class="alert-close"
            onclick="this.parentElement.style.display='none'"
        >
            &times;
        </button>
    </div>
<?php endif; ?>

<h1>FRA Creation</h1>

<div class="create-form-card">
    <form method="POST" enctype="multipart/form-data">
        <div class="create-form-grid">
            <div class="create-form-group">
                <label for="campaign_title">Campaign Title</label>
                <input
                    type="text"
                    id="campaign_title"
                    name="campaign_title"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['campaign_title'] ?? '') ?>"
                    required
                >
            </div>

            <div class="create-form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat) ?>"
                            <?= (($_POST['category'] ?? '') === $cat) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="create-form-group">
                <label for="goal_amount">Target Amount</label>
                <input
                    type="text"
                    id="goal_amount"
                    name="goal_amount"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['goal_amount'] ?? '') ?>"
                    inputmode="decimal"
                    oninput="
                        this.value = this.value
                            .replace(/[^0-9.]/g, '')
                            .replace(/(\..*)\./g, '$1');
                    "
                    required
                >
            </div>

            <div class="create-form-group">
                <label for="end_date">End Date</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['end_date'] ?? '') ?>"
                    min="<?= date('Y-m-d') ?>"
                    required
                >
            </div>
        </div>

        <div class="create-form-group">
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                class="form-control"
                rows="5"
                required
            ><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
        </div>

        <div class="create-form-grid">
            <div class="create-form-group">
                <label for="donee_name">Donee Name</label>
                <input
                    type="text"
                    id="donee_name"
                    name="donee_name"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['donee_name'] ?? '') ?>"
                >
            </div>

            <div class="create-form-group">
                <label for="phone">Phone</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    class="form-control"
                    value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                    placeholder="Enter 8-digit phone number"
                    inputmode="numeric"
                    maxlength="8"
                    pattern="[89][0-9]{7}"
                    oninput="
                        this.value = this.value
                            .replace(/[^0-9]/g, '')
                            .slice(0, 8);

                        if (this.value.length > 0 &&
                            this.value[0] !== '8' &&
                            this.value[0] !== '9') {
                            this.value = '';
                        }
                    "
                    required
                >
            </div>
        </div>

        <div class="create-form-actions">
            <button type="submit" class="create-save-btn">Create FRA</button>
            <a href="create_fra.php" class="create-cancel-btn">Cancel</a>
        </div>
    </form>
</div>

<script>


    const fraAlert = document.getElementById('fraAlert');
    if (fraAlert) {
        setTimeout(() => {
            fraAlert.style.display = 'none';
        }, 3000);
    }
</script>