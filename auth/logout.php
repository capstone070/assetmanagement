<?php
require __DIR__ . '/../lib/header.php';
if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    log_message("{$_SESSION['user']['UserName']} has logged out.");
    unset($_SESSION['user']);
}

header('location: ' . ($_POST['uri'] ? $_POST['uri'] : '/'));
