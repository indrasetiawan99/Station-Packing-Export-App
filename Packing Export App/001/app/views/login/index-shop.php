<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- JQuery -->
    <script src="<?= BASEURL; ?>/plugins/jquery-3.5.1/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/bootstrap-4.6/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="<?= BASEURL; ?>/plugins/bootstrap-4.6/js/bootstrap.bundle.min.js"></script>

    <!-- Sweetalert2 CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/sweetalert2/css/sweetalert2.min.css">

    <!-- Sweetalert2 JS -->
    <script src="<?= BASEURL; ?>/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/login.css">

    <title>Login Shopping</title>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-white bg-dark">
        <a class="navbar-brand" href="#">
            <div class="col">
                <div class="row">
                    <img src="<?= BASEURL; ?>/img/logo-api-panjang.png" width="" height="40" alt="">
                </div>
            </div>
        </a>

        <div class="col">
            <div class="row">
                <span class="ml-auto" id="jam" style="color: #d7d7d7; font-weight: bold;"></span>
            </div>
            <div class="row">
                <span class="ml-auto" id="tanggal" style="color: #d7d7d7; font-weight: bold;"></span>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">

        <div class="row">
            <div class="col">
                <center>
                    <div class="mt-5" id="formContent">
                        <!-- Tabs Titles -->

                        <!-- Icon -->
                        <div class="">
                            <h2>Login</h2>
                            <hr style="width:50%;text-align:center;">
                        </div>

                        <!-- Login Form -->
                        <form action="#" class="signin-form" method="post">
                            <input type="text" id="username" name="username" placeholder="username" autocomplete="off">
                            <input type="password" id="password" name="password" placeholder="password" autocomplete="off">
                            <input type="submit" id="btn-submit" value="submit">
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <!-- Extension Javascript Program -->
    <div>
        <script src="<?= BASEURL; ?>/js/timer.js"></script>
        <script src="<?= BASEURL; ?>/js/login-shop.js"></script>
    </div>
</body>

</html>