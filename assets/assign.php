<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$all = all();
$row = [
    'id' => '',
    'assetId' => $_GET['assetId'],
    'assignDate' => date('Y-m-d')
];

if (isset($_GET['id'])) {
    $row = viewAssignment($_GET['id']);
}
$asset = view($row['assetId']);

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $result = saveAssignment($_POST);
    $row = $_POST;
    if ($result !== true) {
        $_SESSION['error'] = join('<br/>', $result);
    }
}

$employees = DB::query('SELECT * FROM employee ORDER BY FirstName');

?>
<?php display_message(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Assets</a></li>
            <li class="breadcrumb-item"><a href="view.php?id=<?= $asset['id'] ?>"><?= $asset['name'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Assign</li>
        </ol>
    </nav>
    <h1 class="display-1">Assign asset</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="assetId" value="<?= $row['assetId'] ?>">
        <div class="mb-3">
            <label class="form-label">Employee</label>
            <select name="employeeId" class="form-select">
                <option value=""></option>
                <?php foreach ($employees as $emp) : ?>
                    <option value="<?= $emp['id'] ?>" <?= $row['employeeId'] === $emp['id'] ? 'selected' : '' ?>><?= $emp['FirstName'] ?> <?= $emp['LastName'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="assignDate" value="<?= $row['assignDate'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" name="remarks"><?= htmlentities($row['remarks']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success"><?= $row['id'] ? 'Save' : 'Submit' ?></button>
    </form>
</div>

<?php require __DIR__ . '/../lib/footer.php'; ?>