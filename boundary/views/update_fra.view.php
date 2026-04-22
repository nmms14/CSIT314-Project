<?php if (!empty($popupMessage)): ?>
    <div id="fraAlert" class="alert-popup <?= htmlspecialchars($popupType) ?>">
        <span><?= htmlspecialchars($popupMessage) ?></span>
        <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
<?php endif; ?>

<h1>FRA Update</h1>

<?php if ($mode === 'list'): ?>
    <div class="table-wrap">
        <table class="table-base update-fra-table">
            <thead>
                <tr>
                    <th>Campaign Title</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th>Donee</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($fraList)): ?>
                    <?php foreach ($fraList as $fraItem): ?>
                        <tr>
                            <td><?= htmlspecialchars($fraItem['campaign_title']) ?></td>
                            <td><?= htmlspecialchars($fraItem['category']) ?></td>
                            <td>$<?= number_format((float)$fraItem['goal_amount'], 0) ?></td>
                            <td><?= htmlspecialchars(date('Y/m/d', strtotime($fraItem['end_date']))) ?></td>
                            <td><?= htmlspecialchars($fraItem['description']) ?></td>
                            <td><?= htmlspecialchars($fraItem['donee_name']) ?></td>
                            <td><?= htmlspecialchars($fraItem['phone']) ?></td>
                            <td>
                                <a href="update_fra.php?id=<?= (int)$fraItem['id'] ?>" class="edit-btn">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No fundraising activities found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($mode === 'form' && $fra): ?>
    <div class="update-form-card">
        <form method="POST">
            <input type="hidden" name="id" value="<?= (int)$fra['id'] ?>">

            <div class="update-form-grid">
                <div class="update-form-group">
                    <label for="campaign_title">Campaign Title</label>
                    <input
                        type="text"
                        id="campaign_title"
                        name="campaign_title"
                        class="form-control"
                        value="<?= htmlspecialchars($fra['campaign_title']) ?>"
                        required
                    >
                </div>

                <div class="update-form-group">
    <label for="category">Category</label>

    <select
        id="category"
        name="category"
        class="form-control"
        required
    >
        <option value="">-- Select Category --</option>

        <option value="Medical"
            <?= $fra['category'] === 'Medical' ? 'selected' : '' ?>>
            Medical
        </option>

        <option value="Education"
            <?= $fra['category'] === 'Education' ? 'selected' : '' ?>>
            Education
        </option>

        <option value="Social"
            <?= $fra['category'] === 'Social' ? 'selected' : '' ?>>
            Social
        </option>

        <option value="Disaster Relief"
            <?= $fra['category'] === 'Disaster Relief' ? 'selected' : '' ?>>
            Disaster Relief
        </option>

        <option value="Animal Welfare"
            <?= $fra['category'] === 'Animal Welfare' ? 'selected' : '' ?>>
            Animal Welfare
        </option>

        <option value="Community"
            <?= $fra['category'] === 'Community' ? 'selected' : '' ?>>
            Community
        </option>

        <option value="Others"
            <?= $fra['category'] === 'Others' ? 'selected' : '' ?>>
            Others
        </option>
    </select>
</div>

                <div class="update-form-group">
    <label for="goal_amount">Target Amount</label>
    <input
        type="text"
        id="goal_amount"
        name="goal_amount"
        class="form-control"
        value="<?= htmlspecialchars(number_format((float)$fra['goal_amount'], 0, '.', '')) ?>"
        required
        inputmode="decimal"
        oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
    >
            </div>

                <div class="update-form-group">
                    <label for="end_date">End Date</label>
                    <input
                        type="date"
                        id="end_date"
                        name="end_date"
                        class="form-control"
                        value="<?= htmlspecialchars($fra['end_date']) ?>"
                        required
                    >
                </div>
            </div>

            <div class="update-form-group">
                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    rows="4"
                    required
                ><?= htmlspecialchars($fra['description']) ?></textarea>
            </div>

            <div class="update-form-grid">
                <div class="update-form-group">
                    <label for="donee_name">Donee Name</label>
                    <input
                        type="text"
                        id="donee_name"
                        name="donee_name"
                        class="form-control"
                        value="<?= htmlspecialchars($fra['donee_name']) ?>"
                        required
                    >
                </div>

                <div class="update-form-group">
    <label for="phone">Phone</label>
    <input
    type="tel"
    id="phone"
    name="phone"
    class="form-control"
    value="<?= htmlspecialchars($fra['phone']) ?>"
    required
    inputmode="numeric"
    maxlength="8"
    placeholder="Enter 8-digit phone number"
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
>
</div>
            </div>

            <div class="update-form-actions">
                <button type="submit" class="update-save-btn">Update</button>
                <button type="submit" name="cancel_update" value="1" class="update-cancel-btn">Cancel</button>
            </div>
        </form>
    </div>
<?php else: ?>
    <p>Fundraising activity not found.</p>
<?php endif; ?>

<script>
const fraAlert = document.getElementById('fraAlert');
if (fraAlert) {
    setTimeout(() => {
        fraAlert.style.display = 'none';
    }, 3000);
}
</script>