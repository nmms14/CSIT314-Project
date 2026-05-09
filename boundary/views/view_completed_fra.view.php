<h1>View Completed FRA</h1>

<div class="view-fra-container">

    <table class="view-fra-table statistics-table">

        <thead>
            <tr>
                <th>Fundraiser</th>
                <th>Campaign</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <?php if (!empty($results)): ?>

                <?php foreach ($results as $row): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars(
                                $row['fundraiser_name'] ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row['campaign_title'] ?? '-'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $row['category'] ?? '-'
                            ) ?>
                        </td>

                        <td>
                            $<?= number_format(
                                (float)($row['goal_amount'] ?? 0),
                                0
                            ) ?>
                        </td>

                        <td>   
							Completed
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="5"
                        style="text-align:center;">

                        No completed FRA found.

                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>