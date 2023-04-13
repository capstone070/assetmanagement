<?php

function all()
{
    return DB::query('SELECT * FROM user ORDER BY id');
}

function view($id)
{
    $row = DB::queryFirstRow('SELECT * FROM user WHERE id = %s', $id);
    if (!$row) {
        $_SESSION['error'] = 'Record not found.';
        header('location: index.php');
        exit;
    }
    return $row;
}

function delete($id)
{
    DB::delete('user', 'id=%s', $id);
}

function save(&$row)
{
    $errors = [];
    if (!$row['id']) {
        unset($row['id']);
    }

    if (!validate($row, [
        'UserName' => 'required',
        'NewPassword' => 'required_without:id',
        'UserLevel' => 'required',
    ], [
        'UserName' => 'Username',
        'NewPassword' => 'New password',
        'UserLevel' => 'Level',
    ])) {
        return false;
    }

    if ($row['id']) {
        $exists = DB::queryFirstRow('SELECT * FROM user WHERE UserName = %s AND id != %s', $row['UserName'], $row['id']);
        if ($exists) {
            return ['UserName' => 'Username already taken'];
        }

        if ($row['NewPassword']) {
            $row['Password'] = sha1($row['NewPassword']);
        }
        unset($row['NewPassword']);
        DB::update('user', $row, 'id=%s', $row['id']);

        log_message("{$_SESSION['user']['UserName']} updated user $row[UserName].");
    } else {
        // Check if user already exists
        $exists = DB::queryFirstRow('SELECT * FROM user WHERE UserName = %s', $row['UserName']);
        if ($exists) {
            return ['UserName' => 'Username already taken'];
        }

        $row['Password'] = sha1($row['NewPassword']);
        unset($row['id']);
        unset($row['NewPassword']);
        DB::insert('user', $row);
        $row['id'] = DB::insertId();

        log_message("{$_SESSION['user']['UserName']} created user $row[UserName].");
    }
    $_SESSION['message'] = 'Save successfully.';
    header('location: view.php?id=' . $row['id']);
    return true;
}
