<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$row = view($_GET['id']);
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['FirstName'] ?> <?= $row['LastName'] ?></li>
        </ol>
    </nav>
    <h1 class="display-1"><?= $row['FirstName'] ?> <?= $row['LastName'] ?></h1>
    <div class="my-3">
        <a class="btn btn-primary" href="update.php?id=<?= $row['id'] ?>">Update</a>
        <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="d-inline">
            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    <div class="card">
        <table class="table table-striped-columns mb-0">
            <tr>
                <th>ID</th>
                <td><?= $row['id'] ?></td>
            </tr>
            <tr>
                <th>First name</th>
                <td><?= $row['FirstName'] ?></td>
            </tr>
            <tr>
                <th>Last name</th>
                <td><?= $row['LastName'] ?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><?= $row['MobileNumber'] ?></td>
            </tr>
        </table>
    </div>
</div>
<?php require __DIR__ . '/../lib/footer.php'; ?>