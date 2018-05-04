<?php
    function print_posts() {
        require_once 'db_work.php';
        $posts = get_posts($_SESSION['page_curr']);
        foreach ($posts as $content => $author) {
            echo "<p><i>$author</i> posted:</p>";
            echo "<p>$content</p><hr>";
        }
    }

    function print_page_nav() {
        $item_prev_status = '';
        $item_next_status = '';
        $item_prev_ref = '';
        $item_next_ref = '';

        if ($_SESSION['page_curr'] == 1) {
            $item_prev_status = 'disabled';
        } else {
            $item_prev_ref = 'index.php?pg='.($_SESSION['page_curr'] - 1);
        }

        if ($_SESSION['page_curr'] == $_SESSION['page_count']) {
            $item_next_status = 'disabled';
        } else {
            $item_next_ref = 'index.php?pg='.($_SESSION['page_curr'] + 1);
        }

        echo '<li class="page-item '.$item_prev_status.'"><a class="page-link" href="'.$item_prev_ref.'">Prev</a></li>';
        for ($i = 1; $i <= $_SESSION['page_count']; $i++) {
            echo '<li class="page-item"><a class="page-link" href="index.php?pg='.$i.'">'.$i.'</a></li>';
        }
        echo '<li class="page-item '.$item_next_status.'"><a class="page-link" href="'.$item_next_ref.'">Next</a></li>';
    }