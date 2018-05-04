<?php
    session_start();
    require_once 'db_work.php';

    $new_post_page = $_SESSION['page_count'];
    $posts_count = get_posts_count();
    //if we have 3 posts on the last page
    if ($posts_count/$_SESSION['page_count'] == 3) {
        $new_post_page++;
    }

    $content = trim(strip_tags($_POST['text']));
    if (!empty($content)) add_post($_SESSION['username'], $content, $new_post_page);

    require_once 'initialization.php';
    page_count_init();

    require_once 'const.php';
    header('Location: '.MAIN_PAGE);