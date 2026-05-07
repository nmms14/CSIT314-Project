<?php
$monthString = $monthString ?? '';
$errorMessage = $errorMessage ?? '';
?>

<h1 style="margin:0 0 24px;">Generate Monthly Report</h1>

<?php if ($errorMessage !== ''): ?>
    <div class="alert-popup error">
        <span><?= htmlspecialchars($errorMessage) ?></span>
        <button type="button" class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
    </div>
<?php endif; ?>

<div style="min-height: calc(100vh - 68px - 68px - 80px); display:flex; align-items:center; justify-content:center;">
    <div class="form-card" style="max-width:520px; width:100%; margin:0; padding:28px; border:1px solid #d1d5db; border-radius:14px; background:#fff;">
        <form method="POST" action="">
            <div class="form-group">
                <label for="month">Select month <span style="color:#dc2626">*</span></label>
                <input
                    type="month"
                    id="month"
                    name="month"
                    class="form-control"
                    value="<?= htmlspecialchars($monthString) ?>"
                    required
                    placeholder="YYYY-MM"
                >
                <p style="margin:8px 0 0; font-size:0.85rem; color:#6b7280;">The report will cover all days in the selected month.</p>
            </div>

            <div style="display:flex; gap:10px; justify-content:center;">
                <button type="submit" class="btn" style="background:#2563eb;color:#fff;border-color:#2563eb;">Generate Report</button>
                <a href="dashboard_pm.php" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>
