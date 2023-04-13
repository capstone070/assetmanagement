<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    deleteAssignment($_POST['id']);
    $_SESSION['message'] = 'Successfully removed item.';
}

header('location: view.php?id=' . $_POST['assetId']);
