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

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/plugins/select2/dist/css/select2.min.css">

    <!-- Select2 JS -->
    <script src="<?= BASEURL; ?>/plugins/select2/dist/js/select2.min.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/operator.css">

    <title>Operator View</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-white bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?= BASEURL; ?>/img/logo-api-panjang.png" width="" height="40" alt="">
        </a>
        <h2 class="font-weight-bold c1" style="margin-left: 290px;">Shopping Export</h2>
        <div class="col">
            <div class="row">
                <span class="ml-auto font-weight-bold c1">Operator Interface</span>
            </div>
            <div class="row">
                <span class="ml-auto c1">Production Line |</span>
                <span class="c2">.</span>
                <span class="c1" id="the-line">Boxing</span>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container-fluid mt-2">
        <audio id="ok-sound">
            <source src="<?= BASEURL; ?>/sound/ok.mp3" type="audio/mpeg">
        </audio>
        <audio id="ng-sound">
            <source src="<?= BASEURL; ?>/sound/ng.mp3" type="audio/mpeg">
        </audio>
        <!-- <div class="text-center">
            <label id="lbl-qty" class="font-weight-bold" style="font-size: 300px;">0</label>
        </div> -->
        <div class="row mt-2">
            <h5 class="card-title text-center font-weight-bold" style="margin-left: 50px; margin-top: 12px"><?= $_SESSION['login-shop']['usergroup']; ?> :</h5>
            <h4 id="op-name" class="font-weight-bold" style="background-color: #e9ecef; padding: 0px 10px 4px; border-radius: 5px; margin-left: 30px; margin-top: 10px;"><?= $_SESSION['login-shop']['name']; ?></h4>
        </div>
        <div class="row mt-2">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center font-weight-bold" style="margin-top: 10px">Kanban Customer</h5>
                        <div class="form-group" style="margin-top: 50px;">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Name</h6>
                                    <h4 id="cust-part-name" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Number Customer</h6>
                                    <h4 id="cust-pn-cust" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Number API</h6>
                                    <h4 id="cust-pn-api" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="<?= BASEURL; ?>/img/vs.png" width="100%" alt="">
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center font-weight-bold" style="margin-top: 10px">Kanban API</h5>
                        <div class="form-group" style="margin-top: 50px;">
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Name</h6>
                                    <h4 id="api-part-name" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Number Customer</h6>
                                    <h4 id="api-pn-cust" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <h6>Part Number API</h6>
                                    <h4 id="api-pn-api" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px;">-</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="fixed-bottom">
        <div class="card-footer text-muted bg-dark h70">
            <div class="row">
                <div class="col-sm-1">
                    <a href="<?= BASEURL; ?>/login/indexShop" class="btn btn-warning btn-block" title="Logout">
                        <img src="<?= BASEURL; ?>/img/logout.png" width="30">
                    </a>
                </div>
                <div class="col-sm-1">
                    <button id="btn-delete" class="btn btn-warning btn-block" title="Delete Data">
                        <img src="<?= BASEURL; ?>/img/delete.png" height="30">
                    </button>
                </div>
                <?php if ($_SESSION['login-shop']['usergroup'] != 'Operator') { ?>
                    <div class="col-sm-1">
                        <button id="btn-unlock" class="btn btn-warning btn-block" title="Unlock App">
                            <img src="<?= BASEURL; ?>/img/unlock.png" height="30">
                        </button>
                    </div>
                <?php } ?>
                <div class="col px-4">
                    <div class="row">
                        <span class="ml-auto font-weight-bold c1" id="jam"></span>
                    </div>
                    <div class="row">
                        <span class="ml-auto font-weight-bold c1" id="tanggal"></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Extension Javascript Program -->
    <div>
        <script src="<?= BASEURL; ?>/js/timer.js"></script>
        <script src="<?= BASEURL; ?>/js/shop.js"></script>
        <script>
            $(function() {
                $('.select2').select2();
            });
        </script>
    </div>
</body>

</html>