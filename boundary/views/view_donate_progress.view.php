<h1>Donation Progress</h1>

<?php if (!empty($results)): ?>

    <?php foreach ($results as $fra): ?>

        <?php

        $progress =
            (
                $fra['total_raised']
                /
                $fra['goal_amount']
            ) * 100;

        $progress = min($progress, 100);

        $status =
            (
                $fra['total_raised']
                >=
                $fra['goal_amount']

                ||

                time() >
                strtotime($fra['end_date'])
            )

            ? 'Completed'
            : 'Ongoing';

        ?>

        <div class="progress-card">

            <div class="progress-header">

                <h2>
                    <?= htmlspecialchars(
                        $fra['campaign_title']
                    ) ?>
                </h2>

                <span class="category-tag">
                    <?= htmlspecialchars(
                        $fra['category']
                    ) ?>
                </span>

            </div>

            <div class="progress-info-row">

                <p>
                    <strong>Target:</strong>

                    $<?= number_format(
                        (float)$fra['goal_amount'],
                        0
                    ) ?>
                </p>

                <p>
                    <strong>Raised:</strong>

                    $<?= number_format(
                        (float)$fra['total_raised'],
                        0
                    ) ?>
                </p>

                <p>
                    <strong>My Donation:</strong>

                    $<?= number_format(
                        (float)$fra['my_donation'],
                        0
                    ) ?>
                </p>

            </div>

            <div class="progress-section">
				<p>
					<strong>Progress:</strong>
				</p>

				<div class="progress-row">
					<div class="progress-bar">

						<div class="progress-fill"
							 style="width: <?= $progress ?>%">
						</div>

					</div>

					<span class="progress-percent">
						<?= round($progress) ?>%
					</span>
				</div>
			</div>

            <p>
                <strong>End Date:</strong>

                <?= date(
                    'd M Y',
                    strtotime($fra['end_date'])
                ) ?>
            </p>

            <p>
                <strong>Status:</strong>

                <?= $status ?>
            </p>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>No donated FRA found.</p>

<?php endif; ?>