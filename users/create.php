<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$all = all();
$row = [
    'id' => '',
    'EmployeeId' => '',
    'Username' => '',
    'NewPassword' => '',
    'Password' => '',
];

$employee = DB::queryFirstRow('SELECT * FROM employee WHERE id = %s', $_GET['employeeId']);
$row['employeeId'] = $_GET['employeeId'];

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    save($_POST);
    $row = $_POST;
}

$employees = DB::query('SELECT * FROM employee WHERE id NOT IN (SELECT employeeId FROM user) ORDER BY FirstName');
?>
<?php display_message(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <h1 class="display-1">Create user<?php if ($employee) : ?>: <?= $employee['FirstName'] ?> <?= $employee['LastName'] ?><?php endif; ?></h1>
    <?php if ($_GET['employeeId'] && $employee) : ?>
        <?php require '_form.php' ?>
    <?php else : ?>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Select employee
            </button>
            <ul class="dropdown-menu">
                <?php if (count($employees)) : ?>
                    <?php foreach ($employees as $row) : ?>
                        <li><a class="dropdown-item" href="create.php?employeeId=<?= $row['id'] ?>"><?= $row['FirstName'] ?> <?= $row['LastName'] ?></a></li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="dropdown-item">No records found.</li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../lib/footer.php'; ?>