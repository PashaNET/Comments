<!DOCTYPE html>
<?php  $is_logged = (isset($_SESSION['login_user']) && $_SESSION['login_user']  == 'admin'); ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Comments</title>

        <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/assets/css/material_theme.css" />
        <link rel="stylesheet" type="text/css" href="/assets/css/app.styles.css" />
    </head>
    <body>
        <nav class="navbar navbar-default material_navbar">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav material_navbar_nav">
                        <li id="-link"><a href="/" class="material_navbar_nav_item">Комментарии пользователей</a></li>
                        <li id="admin-link" class="logged-<?php echo $is_logged; ?>"><a href="/main/admin" class="material_navbar_nav_item">Администратор</a></li>
                    </ul>
                    <ul class="navbar-form navbar-right material_navbar_form">
                        <h4 class="logged-<?php echo $is_logged; ?>">Admin</h4>
                        <button class="logged-<?php echo !$is_logged; ?> btn btn-default material_btn material_btn_sm material_btn_primary" id="login-form">Вход</button>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/main.scripts.js"></script>

        <?php include 'application/views/' . $content; ?>

        <script src="/assets/js/bootstrap.min.js"></script>
    </body>
</html>