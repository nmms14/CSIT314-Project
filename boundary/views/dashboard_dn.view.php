<div class="donee-dashboard-container">

    <section class="welcome-card">
        <h1>Welcome back, <?= htmlspecialchars($_SESSION['username'] ?? 'Donee') ?>!</h1>
        <p>Track your donations and saved fundraising activities here.</p>
    </section>

    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">💝</div>
            <div>
                <p>Total Donations</p>
                <h2><?= $totalDonations ?? 0 ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div>
                <p>Total Donated</p>
                <h2>$<?= number_format($totalAmount ?? 0) ?></h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">⭐</div>
            <div>
                <p>Saved FRAs</p>
                <h2><?= $savedFraCount ?? 0 ?></h2>
            </div>
        </div>
    </section>

    <section class="dashboard-grid">

        <div class="panel">
            <h2>Recent Donations</h2>

            <?php if (!empty($recentDonations)): ?>
                <?php foreach ($recentDonations as $donation): ?>
                    <div class="activity-item">
                        <div class="activity-icon donation-icon">💰</div>
                        <div>
                            <strong><?= htmlspecialchars($donation['campaign_title']) ?></strong>
                            <p>
                                $<?= number_format($donation['amount']) ?>
                                donated on
                                <?= date('d M Y', strtotime($donation['donation_date'])) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No recent donations yet.</p>
            <?php endif; ?>
        </div>

        <div class="panel">

    <h2>🔥 Trending Campaigns</h2>

    <?php if (!empty($trendingCampaigns)): ?>

        <?php foreach ($trendingCampaigns as $campaign): ?>

            <div class="activity-item">

                <div class="activity-icon trending-icon">📈</div>

                <div>

                    <strong>
                        <?= htmlspecialchars($campaign['campaign_title']) ?>
                    </strong>

                    <p>
                        <?= htmlspecialchars($campaign['category']) ?>
                        · Raised:
                        $<?= number_format($campaign['total_raised']) ?>
                    </p>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>No trending campaigns available.</p>

    <?php endif; ?>

</div>

    </section>


</div>