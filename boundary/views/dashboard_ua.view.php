<div class="dashboard-content">

    <section class="welcome-card">
        <h1>
            Welcome back, <?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?>!
        </h1>

        <p>
            Here is an overview of the system user management.
        </p>
    </section>

    <!-- Stats Cards -->
    <section class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">👤</div>

            <div>
                <p>Total Users</p>
                <h2><?= $totalUsers ?? 0 ?></h2>
            </div>
        </div>

        <div class="stat-card">
			<div class="stat-icon">🔒</div>

			<div>
				<p>Suspended Accounts</p>
				<h2><?= $suspendedAccounts ?? 0 ?></h2>
			</div>
		</div>

        <div class="stat-card">
            <div class="stat-icon">🛡️</div>

            <div>
                <p>Total Profiles</p>
                <h2><?= $totalProfiles ?? 0 ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🆕</div>

            <div>
                <p>New Users</p>
                <h2><?= $newUsers ?? 0 ?></h2>
            </div>
        </div>

    </section>

    <!-- Main Dashboard Grid -->
	<section class="dashboard-grid">

		<!-- Newly Created Accounts -->
		<div class="panel">

			<h2>Latest Created Accounts</h2>

			<div class="table-scroll">

				<table class="fra-table">

					<thead>
						<tr>
							<th>Name</th>
							<th>Username</th>
							<th>Profile</th>
							<th>Status</th>
							<th>Created Date</th>
						</tr>
					</thead>

					<tbody>

					<?php if (!empty($recentAccounts)): ?>

						<?php foreach ($recentAccounts as $acc): ?>

							<tr>

								<td>
									<?= htmlspecialchars($acc['name']) ?>
								</td>

								<td>
									<?= htmlspecialchars($acc['username']) ?>
								</td>

								<td>
									<?= htmlspecialchars($acc['profile']) ?>
								</td>

								<td>

									<?php if (
										($acc['status'] ?? '')
										=== 'Suspended'
									): ?>

										<span class="status-inactive">
											Suspended
										</span>

									<?php else: ?>

										<span class="status-active">
											Active
										</span>

									<?php endif; ?>

								</td>

								<td>
									<?= date(
										'd M Y',
										strtotime($acc['created_at'])
									) ?>
								</td>

							</tr>

						<?php endforeach; ?>

					<?php else: ?>

						<tr>
							<td colspan="5">
								No accounts found.
							</td>
						</tr>

					<?php endif; ?>

					</tbody>

				</table>

			</div>

		</div>
		
		<!-- Recent Activities -->
		<div class="panel">

			<h2>Recent Activities</h2>

			<div class="activity-item">

				<span>👤</span>

				<div>

					<strong>
						New User Registered
					</strong>

					<p>
						A new account was recently created.
					</p>

				</div>

			</div>

			<div class="activity-item">

				<span>🔒</span>

				<div>

					<strong>
						Account Suspended
					</strong>

					<p>
						A user account was suspended by admin.
					</p>

				</div>

			</div>

			<div class="activity-item">

				<span>✏️</span>

				<div>

					<strong>
						Profile Updated
					</strong>

					<p>
						A user profile was updated successfully.
					</p>

				</div>

			</div>

			<div class="activity-item">

				<span>🗑️</span>

				<div>

					<strong>
						Account Deleted
					</strong>

					<p>
						An inactive account was removed.
					</p>

				</div>
			</div>
		</div>
	</section>
</div>