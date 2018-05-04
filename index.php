<!DOCTYPE html>
<?php
    session_start();

    require_once 'php-scripts/print.php';
    require_once 'php-scripts/initialization.php';

    current_page_init();

    if (!isset($_SESSION['page_count'])) {
        page_count_init();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Форум</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/table.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-inverse col-lg-12">
    <div class="container" >
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text_nav" href="index.php"><strong>Top of page</strong></a>
        </div>
        <div class="navbar-collapse collapse" >
            <ul class="nav navbar-nav " id="mainNav">
                <li>
                    <a href="check_in.html" >
                        <span class="btn btn-success">Sign up</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="col-lg-4">
        <div class="form-group col-lg-12">
            <div class="form-group col-md-12 col-lg-push-* col-xs-12">
                <div class="row">
                    <h4>
                        Ввод сообщения
                        <?php
                        if (isset($_SESSION['username'])) echo '(<strong>'.$_SESSION['username'].'</strong>)';
                        ?>
                    </h4>
                    <div class="form-group">
                    <form action="php-scripts/new_post.php" method="post">
                        <textarea class="form-control" name="text" id="exampleFormControlTextarea1" aria-describedby="basic-addon1" rows="3"></textarea>
                        <?php
                        if (isset($_SESSION['username'])) echo '<br><button type="submit" class="btn btn-primary">Enter</button>';
                        ?>
                    </form>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo '<br><form  action="php-scripts/logout.php" method="post"><button  type="submit" class="btn btn-success">Logout</button></form>';
                        }
                        ?>
                </div>
				</div>
            </div>
        </div>
        <div class="form-group col-lg-10 col-md-3 col-xs-12">
            <div class="form-group ">
                <div class="form-group">
                    <form role="form" data-toggle="validator" action="php-scripts/login.php" method="post">
                        <div class="row">
                            <div class="col-sm-offset-0 col-sm-0">
                                <a href="recover.html" class="btn btn-link">Recover your password</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Login</label>
                            <input type="text" class="form-control" name="login" id="emailAddress" placeholder="Enter login or email">
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword2">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleDropdownFormPassword2" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="dropdownCheck2">
                            <label class="form-check-label" for="dropdownCheck2">
                                Remember me
                            </label>
                        </div>
                        <?php
                        if (isset($_SESSION['login_message'])) {
                            echo '<font color="red">'.$_SESSION['login_message'].'</font><br>';
                            unset($_SESSION['login_message']);
                        }
                        ?>

                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="content align-top">
        <div class="col-lg-8 col-md-8 col-xs-12 blog-main">
            <h1><strong>Статьи</strong></h1>
            <?php
                print_posts();
            ?>
            <div class="button" align="center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php
                            print_page_nav();
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</body>

</html>