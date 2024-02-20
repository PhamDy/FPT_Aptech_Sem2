<?php
session_start();

    include 'Manager.php';

    $Manager = new Manager();

    date_default_timezone_set('Asia/Ho_Chi_Minh');

    if (isset($_GET['id'])) {
        $employeesId = $_GET['id'];


    }


    header("Location: dashboard.php");
    exit();

?>

