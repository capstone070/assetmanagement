<?php

if (file_exists(__DIR__ . '/config-local.php')) {
    return require 'config-local.php';
} else {
    return [
        // System name
        "name" => "IT Asset Management System for Small and Medium Enterprises",
        "company" => "Ana's Bad Boyz",
        // DB connections
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "database" => "assetmanagement"
    ];
}
