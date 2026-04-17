<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fundraising Activity</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fb;
            margin: 0;
            padding: 0;
        }

        .page-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            border: 1px solid #dcdcdc;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .page-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .page-subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .message {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success {
            background-color: #e8f8ee;
            color: #1f7a3d;
            border: 1px solid #b7e4c7;
        }

        .error {
            background-color: #fdecea;
            color: #b42318;
            border: 1px solid #f5c2c7;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cfcfcf;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-submit {
            background-color: #2563eb;
            color: white;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .btn-reset {
            background-color: #e5e7eb;
            color: #111827;
        }

        .btn-reset:hover {
            background-color: #d1d5db;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="page-title">Create Fundraising Activity</div>
        <div class="page-subtitle">Enter the fundraising activity details below</div>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo htmlspecialchars($messageType); ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="fra_name">Fundraising Activity Name</label>
                <input type="text" id="fra_name" name="fra_name" placeholder="Enter activity name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Enter activity description" required></textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="goal_amount">Goal Amount ($)</label>
                <input type="number" id="goal_amount" name="goal_amount" step="0.01" placeholder="Enter target amount" required>
            </div>

            <div class="button-group">
                <button type="reset" class="btn btn-reset">Clear</button>
                <button type="submit" class="btn btn-submit">Create FRA</button>
            </div>
        </form>
    </div>
</body>
</html>