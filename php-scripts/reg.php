<?php
    session_start();
    require_once 'db_work.php';

    register_user($_POST['login'], $_POST['password']);
    $_SESSION['username'] = $_POST['login'];

    require_once 'const.php';
    header('Location: '.MAIN_PAGE);