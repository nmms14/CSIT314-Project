<?php if (!empty($popupMessage)): ?>
    <div id="fraAlert" class="alert-popup <?= $popupType ?>">
        <span><?= htmlspecialchars($popupMessage) ?></span>
        <button type="button" class="alert-close" onclick="closeStatusPopup()">&times;</button>
    </div>
<?php endif; ?>



<div class="page-header">
    <h1>FRA Deletion</h1>
</div>


<div class="table-wrap">
    <table class="table-base delete-fra-table">
        <thead>
            <tr>
                <th>Campaign Title</th>
                <th>Category</th>
                <th>Amount</th>
                <th>End Date</th>
                <th>Donee</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($fraList)): ?>
                <?php foreach ($fraList as $fra): ?>
                    <tr>
                        <td><?= htmlspecialchars($fra['campaign_title']) ?></td>
                        <td><?= htmlspecialchars($fra['category']) ?></td>
                        <td>$<?= number_format((float)$fra['goal_amount'], 0) ?></td>
                        <td><?= htmlspecialchars(date('Y/m/d', strtotime($fra['end_date']))) ?></td>
                        <td><?= htmlspecialchars($fra['donee_name']) ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this fundraising activity?');">
                                <input type="hidden" name="delete_id" value="<?= (int)$fra['id'] ?>">
                                <button type="button" class="delete-btn"
                                    onclick="openDeleteModal(<?= (int)$fra['id'] ?>, '<?= htmlspecialchars($fra['campaign_title']) ?>')">
                                    Delete
                                </button>
                            </form>
                            <form id="deleteForm" method="POST">
                                <input type="hidden" name="delete_id" id="delete_id">
                                <input type="hidden" name="delete_cancelled" id="delete_cancelled">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">No fundraising activities found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div id="deleteModal" class="delete-modal">
    <div class="delete-modal-card">
        <h2>⚠ Confirm Deletion</h2>
        <p id="deleteModalText"></p>

        <div class="delete-modal-actions">
            <button type="button" class="delete-btn-confirm" onclick="confirmDelete()">Delete</button>
            <button type="button" class="delete-btn-cancel" onclick="cancelDelete()">Cancel</button>
        </div>
    </div>
</div>
</div>
<script>
let selectedId = null;

function openDeleteModal(id, title) {
    selectedId = id;
    document.getElementById("deleteModalText").innerText =
        'Are you sure you want to delete "' + title + '"?';
    document.getElementById("deleteModal").style.display = "flex";
}

function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}

function confirmDelete() {
    document.getElementById("delete_id").value = selectedId;
    document.getElementById("delete_cancelled").value = "";
    document.getElementById("deleteForm").submit();
}

function cancelDelete() {
    document.getElementById("delete_id").value = "";
    document.getElementById("delete_cancelled").value = "1";
    document.getElementById("deleteForm").submit();
}

const fraAlert = document.getElementById('fraAlert');
if (fraAlert) {
    setTimeout(() => {
        fraAlert.style.display = 'none';
    }, 3000);
}
</script>