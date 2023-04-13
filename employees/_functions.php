<?php

function all()
{
    return DB::query('SELECT A.*,B.id as userId FROM employee A LEFT JOIN user B ON A.id = B.employeeId ORDER BY A.FirstName');
}

function view($id)
{
    $row = DB::queryFirstRow('SELECT * FROM employee WHERE id = %s', $id);
    if (!$row) {
        $_SESSION['error'] = 'Record not found.';
        header('location: index.php');
        exit;
    }
    return $row;
}

function save(&$row)
{
    if (!$row['id']) {
        unset($row['id']);
    }

    if (!validate($row, [
        'FirstName' => 'required',
        'LastName' => 'required',
    ], [
        'FirstName' => 'First name',
        'LastName' => 'Last name',
    ])) {
        return false;
    }

    if ($row['id']) {
        DB::update('employee', $row, 'id=%s', $row['id']);
        log_message("{$_SESSION['user']['UserName']} updated employee {$row['FirstName']} {$row['LastName']}.");
    } else {
        unset($row['id']);
        DB::insert('employee', $row);
        $row['id'] = DB::insertId();
        log_message("{$_SESSION['user']['UserName']} created employee {$row['FirstName']} {$row['LastName']}.");
    }
    $_SESSION['message'] = 'Save successfully.';
    header('location: view.php?id=' . $row['id']);
    return true;
}
