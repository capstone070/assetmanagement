<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$all = all();
$row = [
    'id' => '',
    'purchasedDate' => date('Y-m-d'),
    'status' => 'Active'
];

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    save($_POST);
    $row = $_POST;
}
?>
<?php display_message(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Assets</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h1 class="display-1">Create asset</h1>
    <?php require '_form.php' ?>
</div>

<?php require __DIR__ . '/../lib/footer.php'; ?>