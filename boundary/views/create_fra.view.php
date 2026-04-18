<?php if (!empty($message)): ?>
    <div class="alert-popup <?= htmlspecialchars($messageType) ?>" id="fraAlert">
        <div><?= htmlspecialchars($message) ?></div>
        <button type="button" class="alert-close" onclick="document.getElementById('fraAlert').style.display='none'">×</button>
    </div>
<?php endif; ?>

<h1>FRA Creation</h1>

<form method="POST" enctype="multipart/form-data" class="form-card">
    <div class="form-grid">
        <div class="form-group">
            <label>Campaign Title</label>
            <input type="text" name="campaign_title" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                <option value="Medical">Medical</option>
                <option value="Education">Education</option>
                <option value="Social">Social</option>
                <option value="Disaster Relief">Disaster Relief</option>
                <option value="Animal Welfare">Animal Welfare</option>
                <option value="Community">Community</option>
                <option value="Others">Others</option>
            </select>
        </div>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label>Target Amount</label>
            <div class="money-input">
                <span>$</span>
                <input type="text" name="target_amount" placeholder="Enter amount"
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
        </div>

        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="5" class="form-control" required></textarea>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label>Donee Name</label>
            <input type="text" name="donee_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control"
                   placeholder="Enter 8-digit phone number"
                   pattern="[89][0-9]{7}"
                   title="Phone number must be 8 digits and start with 8 or 9"
                   maxlength="8"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,8)"
                   required>
        </div>
    </div>

    <div class="form-group">
        <label>Upload Supporting Documents</label>
        <input type="file" id="supporting_documents" name="supporting_documents[]" multiple
               style="display:none;" onchange="handleFiles(this)">
        <button type="button" class="btn" onclick="document.getElementById('supporting_documents').click()">
            Choose Files
        </button>

        <div id="fileList" class="file-list"></div>

        <small style="color:#6b7280;">
            You may upload multiple supporting files and remove any before submission.
        </small>
    </div>

    <div style="display:flex; gap:12px;">
        <button type="submit" class="btn">Create FRA</button>
        <a href="dashboard_fr.php" class="btn">Cancel</a>
    </div>
</form>

<script>
    let selectedFiles = [];

    function handleFiles(input) {
        const newFiles = Array.from(input.files);

        newFiles.forEach(file => {
            const exists = selectedFiles.some(
                f => f.name === file.name && f.size === file.size && f.lastModified === file.lastModified
            );
            if (!exists) {
                selectedFiles.push(file);
            }
        });

        updateFileInput();
        renderFileList();
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updateFileInput();
        renderFileList();
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('supporting_documents').files = dataTransfer.files;
    }

    function renderFileList() {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = '';

        if (selectedFiles.length === 0) {
            fileList.innerHTML = '<p style="color:#6b7280; margin:0;">No files selected.</p>';
            return;
        }

        selectedFiles.forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'file-item';
            item.innerHTML = `
                <span>${file.name}</span>
                <button type="button" class="btn" onclick="removeFile(${index})">Remove</button>
            `;
            fileList.appendChild(item);
        });
    }

    renderFileList();

    const fraAlert = document.getElementById('fraAlert');
    if (fraAlert) {
        setTimeout(() => {
            fraAlert.style.display = 'none';
        }, 3000);
    }
</script>