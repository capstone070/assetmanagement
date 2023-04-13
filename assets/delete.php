<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $row = view($_POST['id']);
    delete($_POST['id']);
    $_SESSION['message'] = 'Successfully removed item.';
    log_message("{$_SESSION['user']['UserName']} deleted asset $row[name].");
}

header('location: index.php');
