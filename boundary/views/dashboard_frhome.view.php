<div class="dashboard-content">

    <section class="welcome-card">
        <h1>
            Welcome back, <?= htmlspecialchars($_SESSION['username'] ?? 'Fundraiser') ?>!
        </h1>
        <p>Here is an overview of your active fundraising activities.</p>
    </section>

    <!-- Stats Cards -->
    <section class="stats-grid">

        <div class="stat-card">
            <div class="stat-icon">📁</div>
            <div>
                <p>Total Active FRAs</p>
                <h2><?= $totalActiveFra ?? 0 ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div>
                <p>Total Raised</p>
                <h2>$ <?= number_format($totalRaised ?? 0, 2) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div>
                <p>Total Goal</p>
                <h2>$ <?= number_format($totalGoal ?? 0, 2) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📈</div>
            <div>
                <p>Average Progress</p>
                <h2><?= $averageProgress ?? 0 ?>%</h2>
            </div>
        </div>

    </section>

    <!-- Main Dashboard Grid -->
    <section class="dashboard-grid">

        <!-- FRA Progress -->
        <div class="panel">

            <h2>My Active FRA Progress</h2>

            <div class="table-scroll">
            <table class="fra-table">

                <thead>
                    <tr>
                        <th>FRA Title</th>
                        <th>Progress</th>
                        <th>Raised</th>
                        <th>Goal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($activeFras)): ?>

                        <?php foreach ($activeFras as $fra): ?>

                            <?php
                                $progress = 0;

                                if ($fra['goal_amount'] > 0) {
                                    $progress = min(
                                        100,
                                        round(($fra['raised_amount'] / $fra['goal_amount']) * 100)
                                    );
                                }
                            ?>

                            <tr>

                                <td><?= htmlspecialchars($fra['campaign_title']) ?></td>

                                <td>
                                    <span><?= $progress ?>%</span>

                                    <div class="progress-bar">
                                        <div style="width: <?= $progress ?>%;"></div>
                                    </div>
                                </td>

                                <td>
                                    $ <?= number_format($fra['raised_amount'], 2) ?>
                                </td>

                                <td>
                                    $ <?= number_format($fra['goal_amount'], 2) ?>
                                </td>

                                <td>
                                    <span class="status-active">
                                        Active
                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5">
                                No active fundraising activities found.
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

            <?php if (!empty($recentActivities)): ?>

                <?php foreach ($recentActivities as $activity): ?>

                    <div class="activity-item">

                        <span>✅</span>

                        <div>
                            <strong>
                                <?= htmlspecialchars($activity['title']) ?>
                            </strong>

                            <p>
                                <?= htmlspecialchars($activity['description']) ?>
                            </p>
                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p>No recent activities.</p>

            <?php endif; ?>

        </div>

    </section>

</div>