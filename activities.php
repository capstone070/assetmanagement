<?php

require 'lib/header.php';

$logs = DB::query('SELECT * FROM log ORDER BY id DESC LIMIT 10');
?>
<div class="container">
    <h1 class="display-1">Latest activities</h1>
    <div class="card">
        <table class="table table-striped table-hover m-0">
            <thead>
                <tr class="table-secondary">
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($logs) : ?>
                    <?php foreach ($logs as $row) : ?>
                        <tr>
                            <td class="px-3">
                                <?= $row['message'] ?>
                            </td>
                            <td><?= $row['dateCreated'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-muted">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'lib/footer.php'; ?>