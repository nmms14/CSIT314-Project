<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User Account</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: #fff;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            border-right: 1px solid #e5e7eb;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo {
            width: 64px;
            height: 64px;
            border: 1px solid #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            color: #6b7280;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eef2ff;
            color: #374151;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            font-weight: 600;
            border: 1px solid #e5e7eb;
        }

        .btn {
            display: inline-block;
            padding: .45rem 1rem;
            font-size: .875rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            color: #111827;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #f9fafb;
        }

        .content {
            padding: 2rem 1.5rem;
            flex: 1;
			display: flex;
			justify-content: center;   /* horizontal center */
			align-items: center;
			position: relative;
        }

        .content h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .modal.open { display: flex; }

        .modal-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            width: 320px;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
        }

        .modal-card h3 {
            margin: 0 0 .5rem;
            font-size: 1rem;
        }

        .modal-card p {
            margin: 0;
            color: #4b5563;
            font-size: .9rem;
        }

        .modal-actions {
            display: flex;
            gap: .5rem;
            justify-content: center;
            margin-top: 1.25rem;
        }

        .btn-danger {
            background: #dc2626;
            color: #fff;
            border-color: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }
		.aform {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.fields {
			border: 2px solid #e5e7eb;
			border-radius: 16px;
			padding: 30px;
			width: 900px;
		}
		.fields h2 {
			text-align: center;
		}
		input, select {
			width: 100%;
			padding: 8px;
			margin-top: 5px;
			margin-bottom: 10px;
			border: 1px solid #999;
			border-radius: 6px;
		}
		.actions {
			display: flex;
			justify-content: center; 
			gap: 20px;              
			margin-top: 20px;
		}
		.back {
			width: 100%;
			max-width: 100px;   
			position: absolute;
			margin-bottom: 15px;
			top: 20px;
			left: 20px;
		}
		.back-btn {
			color: black;
			font-size:25px;
			font-weight: bold;
			text-decoration: none;
			padding: 6px 14px;
			background: white;
			display: inline-block;
		}
		.success { 
			color: #166534;             
		}

		.error {
			color: #991b1b;
		}
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo">Avatar</div>
        </aside>

        <main class="main">
            <header class="topbar">
                <h2>Dashboard</h2>
                <div class="actions">
                    <div class="avatar">UA</div>
                    <button class="btn" type="button" onclick="showLogout()">Logout</button>
                </div>
            </header>

            <section class="content">
				<div class="back">
					<a href="dashboard_ua.php" class="back-btn">← </a>
				</div>
				
				<div class="aform">
					<?php 
						if (isset($message)) {
							echo "<p class='$msgClass'>$message</p>";
						}
					?>
					<div class="fields">
						<h2>Create an Account</h2>
						<form method="POST">

							<label>Name *</label>
							<br>
							<input type="text" name="name" required>
							<br>

							<label>Username *</label>
							<br>
							<input type="text" name="username" required>
							<br>

							<label>Email *</label>
							<br>
							<input type="email" name="email" required>
							<br>

							<label>Phone Number</label>
							<br>
							<input type="text" name="phone">
							<br>

							<label>Password *</label>
							<br>
							<input type="password" name="password" required>
							<br>

							<label>Profile *</label>
							<br>
							<select name="profile" required>
								<option value="">Select a role..</option>
								<option value="platform_manager">Platform Manager</option>
								<option value="user_admin">User Admin</option>
								<option value="fund_raiser">Fund Raiser</option>
								<option value="donee">Donee</option>
							</select>
							<br>
					</div>
					
						<div class="actions">
							<button type="submit" class="btn">Create</button>
							<button type="button" class="btn" onclick="window.location.href=window.location.href">Cancel</button>
						</div>
			
					</form>
				</div>
            </section>
        </main>
    </div>

    <div class="modal" id="logoutModal">
        <div class="modal-card">
            <h3>Logout Confirmation</h3>
            <p>Are you sure you want to logout?</p>
            <div class="modal-actions">
                <a class="btn btn-danger" href="logout.php">Yes</a>
                <button type="button" class="btn" onclick="hideLogout()">Cancel</button>
            </div>
        </div>
    </div>
	
    <script>
        function showLogout() { document.getElementById('logoutModal').classList.add('open'); }
        function hideLogout() { document.getElementById('logoutModal').classList.remove('open'); }
    </script>
</body>
</html>
