<?php
define('HOST', 'localhost:3306');
define('DATABASE', 'php_project');
define('DBUSER', 'root');
define('DBPASSW', 'epamlab');

function connect() {
    $link = mysqli_connect(HOST, DBUSER, DBPASSW, DATABASE)
    or die('Ошибка ' . mysqli_error($link));

    return $link;
}

function register_user($login, $password) {
    $connection = connect();
    $query = 'INSERT INTO users(login, password) VALUES(?,?)';

    $stmt = $connection -> prepare($query);
    $stmt -> bind_param('ss', $login, get_pasw_hash($login, $password));
    $stmt -> execute();

    $stmt -> close();
    mysqli_close($connection);
}

function validate_user($login, $password) {
    $connection = connect();
    $query = 'SELECT EXISTS(SELECT * FROM users WHERE login = ? AND password = ?)';

    $stmt = $connection -> prepare($query);
    $stmt -> bind_param('ss', $login, get_pasw_hash($login, $password));
    $stmt -> execute();

    $stmt -> bind_result($result);
    $stmt->fetch();

    $stmt -> close();
    mysqli_close($connection);

    return $result;
}

function get_pasw_hash($login, $password) {
    $salt = substr($login,0,3);
    return hash('sha256', $password, $salt);
}

function add_post($user, $text, $page) {
    $connection = connect();
    $query = 'INSERT INTO posts(content, author, pagenum) VALUES(?,?,?)';

    $stmt = $connection -> prepare($query);
    $stmt -> bind_param('ssi', $text, $user,$page);
    $stmt -> execute();

    $stmt -> close();
    mysqli_close($connection);
}

function get_posts($page) {
    $connection = connect();
    $query = 'SELECT * FROM posts WHERE pagenum = ?';
    $stmt = $connection -> prepare($query);
    $stmt -> bind_param('i',$page);
    $stmt -> execute();

    $stmt -> bind_result($id, $content, $author, $page);

    $posts_arr = array();

    while ($stmt -> fetch()) {
        $posts_arr[$content] = $author;
    }

    $stmt -> close();
    mysqli_close($connection);

    return $posts_arr;
}

function get_posts_count() {
    $connection = connect();
    $query = 'SELECT COUNT(*) FROM posts';
    $result = mysqli_query($connection, $query);
    $count = $result -> fetch_row()[0];

    mysqli_close($connection);

    return $count;
}