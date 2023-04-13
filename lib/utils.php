<?php


// Generates uuid v4
function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

// Show message
function display_message()
{
    if (isset($_SESSION['message'])) {
        echo '<div class="container"><div class="alert alert-info">' . $_SESSION['message'] . '</div></div>';
        unset($_SESSION['message']);
    }

    if (isset($_SESSION['error'])) {
        echo '<div class="container"><div class="alert alert-danger"><h5>Error</h5>' . $_SESSION['error'] . '</div></div>';
        unset($_SESSION['error']);
    }
}

// Log message to db
function log_message($message)
{
    DB::insert('log', [
        'message' => $message,
        'userId' => $_SESSION['user']['id'],
        'dateCreated' => date('Y-m-d H:i:s')
    ]);
    return DB::insertId();
}

function validate($data, $rules, $alias = [])
{
    $validator = new \Rakit\Validation\Validator();

    $validation = $validator->make($data, $rules);
    $validation->setAliases($alias);
    $validation->validate();
    
    if ($validation->fails()) {
        $errors = $validation->errors();
        $_SESSION['error'] = join('<br/>', $errors->all());
        return false;
    } else {
        return true;
    }
}
