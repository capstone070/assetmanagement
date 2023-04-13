<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$row = view($_GET['id']);
if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    save($_POST);
    $row = $_POST;
}
?>
<?php display_message(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Employees</a></li>
            <li class="breadcrumb-item"><a href="view.php?id=<?= $row['id'] ?>"><?= $row['FirstName'] ?> <?= $row['LastName'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
    </nav>
    <h1 class="display-1">Update: <?= $row['FirstName'] ?> <?= $row['LastName'] ?></h1>
    <?php require '_form.php' ?>
</div>
<?php require __DIR__ . '/../lib/footer.php'; ?>