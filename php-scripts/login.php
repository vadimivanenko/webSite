<?php
session_start();
require_once 'db_work.php';
require_once 'const.php';

if(empty($_POST['login']) && empty($_POST['password'])) {
    header('Location: '.REG_PAGE);
} else {
    $login = strip_tags($_POST['login']);
    $password = strip_tags($_POST['password']);
    $result = validate_user($login, $password);

    if (empty($result)) {
        $_SESSION['login_message'] = 'Login failed';
    } else {
        if (isset($_POST['remember'])) {
            require_once 'save_user.php';
            remember_me($login, $password);
        }
        unset($_SESSION['login_message']);
        $_SESSION['username'] = $login;
    }

    header('Location: '.MAIN_PAGE);
    exit();
}
