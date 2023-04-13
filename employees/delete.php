<?php
require __DIR__ . '/../lib/header.php';
require __DIR__ . '/_functions.php';

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    $row = view($_POST['id']);
    DB::delete('employee', 'id=%s', $_POST['id']);
    DB::delete('user', 'employeeId=%s', $_POST['id']);
    $_SESSION['message'] = 'Successfully removed item.';
    log_message("{$_SESSION['user']['UserName']} deleted employee $row[FirstName] $row[LastName].");
}

header('location: index.php');
