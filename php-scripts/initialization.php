<?php
    require_once 'db_work.php';

    function page_count_init() {
        $posts_count = get_posts_count();
        if ($posts_count <= 3) {
            $pages_count = 1;
        } else {
            $pages_count = round($posts_count/3,0, PHP_ROUND_HALF_DOWN);
            if ($posts_count%3 != 0) $pages_count++;
        }

        $_SESSION['page_count'] = $pages_count;
    }

    function current_page_init() {
        if (isset($_GET['pg']) && $_GET['pg'] > 0 && $_GET['pg'] <= $_SESSION['page_count']) {
            $_SESSION['page_curr'] = $_GET['pg'];
        } else {
            $_SESSION['page_curr'] = 1;
        }
    }
