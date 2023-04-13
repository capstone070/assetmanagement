<?php

require 'lib/header.php';

if ($_GET['report'] === 'assets') {
    log_message("{$_SESSION['user']['UserName']} downloaded report asset list.");
    $cols = ['id', 'serialNum', 'name', 'description', 'cost', 'purchasedDate', 'assetAge', 'status'];
    $allAssets = DB::query('SELECT ' . join(',', $cols) . ' FROM asset');
    ob_clean();
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . $_SESSION['user']['UserName'] . '-asset-list-' . date('YmdHis') . '.csv"');
    echo '"' . join('","', $cols) . '"';
    foreach ($allAssets as $row) {
        echo "\n" . '"' . join('","', $row) . '"';
    }
} else if ($_GET['report'] === 'replaced') {
    log_message("{$_SESSION['user']['UserName']} downloaded report replaced.");
    $cols = ['id', 'serialNum', 'name', 'description', 'cost', 'purchasedDate', 'assetAge', 'status'];
    $allAssets = DB::query('SELECT ' . join(',', $cols) . ' FROM asset');
    ob_clean();
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . $_SESSION['user']['UserName'] . '-replaced-' . date('YmdHis') . '.csv"');
    echo '"' . join('","', $cols) . '"';
    foreach ($allAssets as $row) {
        echo "\n" . '"' . join('","', $row) . '"';
    }
} else if ($_GET['report'] === 'disposed') {
    log_message("{$_SESSION['user']['UserName']} downloaded report disposed.");
    $cols = ['id', 'serialNum', 'name', 'description', 'cost', 'purchasedDate', 'assetAge', 'status'];
    $allAssets = DB::query('SELECT ' . join(',', $cols) . ' FROM asset');
    ob_clean();
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . $_SESSION['user']['UserName'] . '-disposed-' . date('YmdHis') . '.csv"');
    echo '"' . join('","', $cols) . '"';
    foreach ($allAssets as $row) {
        echo "\n" . '"' . join('","', $row) . '"';
    }
} else if ($_GET['report'] === 'warranty') {
    log_message("{$_SESSION['user']['UserName']} downloaded report warranty.");
    $cols = ['id', 'serialNum', 'name', 'description', 'cost', 'purchasedDate', 'assetAge', 'status'];
    $allAssets = DB::query('SELECT ' . join(',', $cols) . ' FROM asset');
    ob_clean();
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . $_SESSION['user']['UserName'] . '-warranty-' . date('YmdHis') . '.csv"');
    echo '"' . join('","', $cols) . '"';
    foreach ($allAssets as $row) {
        echo "\n" . '"' . join('","', $row) . '"';
    }
}
