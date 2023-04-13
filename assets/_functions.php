<?php

function all()
{
    return DB::query('SELECT * FROM asset ORDER BY id');
}

function view($id)
{
    $row = DB::queryFirstRow('SELECT * FROM asset WHERE id = %s', $id);
    if (!$row) {
        $_SESSION['error'] = 'Record not found.';
        header('location: index.php');
        exit;
    }
    return $row;
}

function viewAssetAssignment($id)
{
    return DB::query('SELECT A.*, B.FirstName, B.LastName FROM assetassignment A LEFT JOIN employee B ON A.employeeId = B.id WHERE assetId = %s', $id);
}

function viewAssignment($id)
{

    $row = DB::queryFirstRow('SELECT * FROM assetassignment WHERE id = %s', $id);
    if (!$row) {
        $_SESSION['error'] = 'Record not found.';
        header('location: index.php');
        exit;
    }
    return $row;
}

function delete($id)
{
    DB::delete('asset', 'id=%s', $id);
    DB::delete('assetassignment', 'assetId=%s', $id);
}

function deleteAssignment($id)
{
    DB::delete('assetassignment', 'id=%s', $id);
}

function save(&$row)
{
    $required = [
        'serialNum' => 'Serial number is required.',
        'name' => 'Name is required.',
        'cost' => 'Cost is required.',
        'purchasedDate' => 'Purchased date is required.',
        'assetAge' => 'Asset age is required.',
        'status' => 'Status is required.',
    ];
    if (!validate($row, [
        'serialNum' => 'required',
        'name' => 'required',
        'cost' => 'required',
        'purchasedDate' => 'required',
        'assetAge' => 'required',
        'status' => 'required',
    ], [
        'serialNum' => 'Serial number',
        'name' => 'Name',
        'cost' => 'Cost',
        'purchasedDate' => 'Purchased date',
        'assetAge' => 'Asset age',
        'status' => 'Status',
    ])) {
        return false;
    }

    if ($row['id']) {
        $exists = DB::queryFirstRow('SELECT * FROM asset WHERE serialNum = %s AND id != %s', $row['serialNum'], $row['id']);
        if ($exists) {
            return ['serialNum' => 'Serial already exists'];
        }

        DB::update('asset', $row, 'id=%s', $row['id']);

        log_message("{$_SESSION['user']['UserName']} updated asset $row[name].");
    } else {
        // Check if asset already exists
        $exists = DB::queryFirstRow('SELECT * FROM asset WHERE serialNum = %s', $row['serialNum']);
        if ($exists) {
            return ['serialNum' => 'Serial already exists'];
        }

        unset($row['id']);
        DB::insert('asset', $row);
        $row['id'] = DB::insertId();

        log_message("{$_SESSION['user']['UserName']} created asset $row[name].");
    }
    $_SESSION['message'] = 'Save successfully.';
    header('location: view.php?id=' . $row['id']);
    return true;
}

function saveAssignment(&$row)
{
    $required = [
        'assetId' => 'Asset ID is required.',
        'employeeId' => 'Employee is required.',
        'assignDate' => 'Assigned date is required.',
    ];
    $errors = [];
    foreach ($required as $key => $value) {
        if (!isset($row[$key]) || empty($row[$key])) {
            $errors[$key] = $value;
        }
    }

    if (count($errors)) {
        return $errors;
    }

    if ($row['id']) {
        DB::update('assetassignment', $row, 'id=%s', $row['id']);
    } else {
        unset($row['id']);
        DB::insert('assetassignment', $row);
        $row['id'] = DB::insertId();
    }
    $_SESSION['message'] = 'Save successfully.';
    header('location: view.php?id=' . $row['assetId']);
    return true;
}
