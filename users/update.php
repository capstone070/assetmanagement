<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$row = view($_GET['id']);
if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    save($_POST);
    $row = array_merge($row, $_POST);
}
?>
<?php display_message(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Users</a></li>
            <li class="breadcrumb-item"><a href="view.php?id=<?= $row['id'] ?>"><?= $row['UserName'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Update</li>
        </ol>
    </nav>
    <h1 class="display-1">Update: <?= $row['UserName'] ?></h1>
    <?php require '_form.php' ?>
</div>
<?php require __DIR__ . '/../lib/footer.php'; ?>