<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$all = all();
?>
<div class="container">
    <h1 class="display-1">Assets</h1>
    <div class="my-3">
        <a class="btn btn-primary" href="create.php">Create</a>
    </div>
    <div class="card mb-3">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr class="table-secondary">
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($all)) : ?>
                    <?php foreach ($all as $row) : ?>
                        <tr>
                            <td><a href="view.php?id=<?= $row['id'] ?>"><?= $row['serialNum'] ?></a></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['purchasedDate'] ?></td>
                            <td class="text-end">
                                <a href="update.php?id=<?= $row['id'] ?>"><i class="bi bi-pencil"></i></a>
                                <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                    <button type="submit" class="btn btn-link p-0"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-muted">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    Total: <?= count($all) ?>
</div>
<?php require __DIR__ . '/../lib/footer.php'; ?>