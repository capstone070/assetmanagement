<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

$row = view($_GET['id']);
$assignements = viewAssetAssignment($_GET['id']);

$options = new QROptions(
    [
        'eccLevel' => QRCode::ECC_L,
        'outputType' => QRCode::OUTPUT_MARKUP_SVG,
        'version' => 5,
    ]
);
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">QR Code</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="<?= $qrcode = (new QRCode($options))->render($row['serialNum']); ?>" />
            </div>
        </div>
    </div>
</div>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Assets</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['name'] ?></li>
        </ol>
    </nav>
    <h1 class="display-1"><?= $row['name'] ?></h1>
    <div class="my-3">
        <a class="btn btn-primary" href="update.php?id=<?= $row['id'] ?>">Update</a>
        <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="d-inline">
            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal" href="update.php?id=<?= $row['id'] ?>"><i class="bi bi-qr-code-scan"></i> QR code</button>
    </div>
    <div class="card">
        <table class="table table-striped-columns mb-0">
            <tr>
                <th>QR Code</th>
                <td></td>
            </tr>
            <tr>
                <th>ID</th>
                <td><?= $row['id'] ?></td>
            </tr>
            <tr>
                <th>Serial number</th>
                <td><?= $row['serialNum'] ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $row['name'] ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?= nl2br($row['description']) ?></td>
            </tr>
            <tr>
                <th>Cost</th>
                <td><?= $row['cost'] ?></td>
            </tr>
            <tr>
                <th>Purchased date</th>
                <td><?= $row['purchasedDate'] ?></td>
            </tr>
            <tr>
                <th>Asset age</th>
                <td><?= $row['assetAge'] ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $row['status'] ?></td>
            </tr>
        </table>
    </div>

    <ul class="nav nav-tabs mt-3">
        <li class="nav-item">
            <a class="nav-link <?= !$_GET['tab'] || $_GET['tab'] === 'employees' ? 'active' : '' ?>" aria-current="page" href="?id=<?= $_GET['id'] ?>&tab=employees">Assignments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $_GET['tab'] === 'images' ? 'active' : '' ?>" aria-current="page" href="?id=<?= $_GET['id'] ?>&tab=images">Images</a>
        </li>
    </ul>

    <?php if (!$_GET['tab'] || $_GET['tab'] === 'employees') : ?>
        <div class="my-3">
            <a href="assign.php?assetId=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Assign</a>
        </div>

        <div class="card mt-3">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Remarks</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($assignements)) : ?>
                        <?php foreach ($assignements as $row) : ?>
                            <tr>
                                <td><?= $row['FirstName'] ?> <?= $row['LastName'] ?></td>
                                <td><?= $row['assignDate'] ?></td>
                                <td><?= nl2br($row['remarks']) ?></td>
                                <td class="text-end">
                                    <a href="assign.php?id=<?= $row['id'] ?>"><i class="bi bi-pencil"></i></a>
                                    <form action="assign-delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                        <input type="hidden" name="assetId" value="<?= $row['assetId'] ?>" />
                                        <button type="submit" class="btn btn-link p-0"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($_GET['tab'] === 'images') : ?>
        <div class="mb-3">
            <p class="my-3 text-muted">Under construction.</p>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/../lib/footer.php'; ?>