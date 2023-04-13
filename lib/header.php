<?php
ob_start();
error_reporting(E_ERROR);

$config = require(__DIR__ . '/config.php');
require(__DIR__ . '/utils.php');
require(__DIR__ . '/db.php');

session_start();

$public_pages = ['/auth/login.php'];
if (!isset($_SESSION['user']) && !in_array($_SERVER['SCRIPT_NAME'], $public_pages)) {
    header('location: /auth/login.php?r=' . urlencode($_SERVER['REQUEST_URI']));
}
?>
<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes1.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $config['name'] ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/static/css/site.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
</head>

<body class="d-flex flex-column h-100 bg-body-tertiary">
    <main class="h-100">
        <?php if (isset($_SESSION['user'])) : ?>
            <header class="p-3 text-bg-dark mb-3 shadow">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none me-3">
                                <img src="/static/images/logo.png" width="100px" />
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarsExample09">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li><a href="/" class="nav-link px-2 <?= $_SERVER['SCRIPT_NAME'] === '/index.php' ? 'text-secondary' : 'text-white' ?>">Home</a></li>
                                    <li><a href="/assets/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/assets/') !== false ? 'text-secondary' : 'text-white' ?>">Assets</a></li>
                                    <li><a href="/employees/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/employees/') !== false ? 'text-secondary' : 'text-white' ?>">Employees</a></li>
                                    <li><a href="/users/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/users/') !== false ? 'text-secondary' : 'text-white' ?>">Users</a></li>
                                    <li><a href="/about/" class="nav-link px-2 <?= strpos($_SERVER['SCRIPT_NAME'], '/about/') !== false ? 'text-secondary' : 'text-white' ?>">About</a></li>
                                </ul>
                                <div>
                                    <div class="dropdown">
                                        <button class="nav-link px-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?= $_SESSION['user']['UserName'] ?>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <form method="POST" action="/auth/logout.php">
                                                <input type="hidden" name="uri" value="<?= $_SERVER['REQUEST_URI'] ?>" />
                                                <button class="dropdown-item" type="submit">Logout</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
        <?php endif; ?>

        <?php display_message(); ?>