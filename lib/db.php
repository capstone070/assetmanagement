<?php
require_once __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/config.php';

DB::$host = $config['host'];
DB::$user = $config['username'];
DB::$password = $config['password'];
DB::$dbName = $config['database'];

//Create Connection to the database
// $conn = mysqli_connect($config['host'], $config['username'], $config['password'], $config['database']);

// Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
