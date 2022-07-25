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
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/operator.css">

    <title>Operator View</title>
</head>

<body id="body-content">
    <!-- Navbar -->
    <nav class="navbar navbar-white bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?= BASEURL; ?>/img/logo-api-panjang.png" width="" height="40" alt="">
        </a>
        <h2 class="font-weight-bold c1" style="margin-left: 230px;">Part Intruction Control</h2>
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
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <h5 class="card-title text-center font-weight-bold" style="padding: 4px 10px; margin-left: 50px; margin-top: 12px">Operator :</h5>
                    <h4 id="op-name" class="font-weight-bold" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px; margin-left: 30px; margin-top: 10px;"></h4>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="row">
                    <h5 class="card-title text-center font-weight-bold" style="padding: 4px 10px; margin-top: 12px">Dock :</h5>
                    <h4 id="dock-code" class="font-weight-bold" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px; margin-left: 30px; margin-top: 10px;"></h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <h5 class="card-title text-center font-weight-bold" style="padding: 4px 10px; background-color: limegreen; padding: 4px 10px; border-radius: 5px; margin-top: 12px">QTY EXPORT :</h5>
                    <h2 id="count-qty" class="font-weight-bold" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px; margin-left: 30px; margin-top: 8px;"></h2>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <h5 class="card-title text-center font-weight-bold" style="padding: 4px 10px; margin-top: 12px">QTY OEM :</h5>
                    <h2 id="count-qty-dom" class="font-weight-bold" style="background-color: #e9ecef; padding: 4px 10px; border-radius: 5px; margin-left: 30px; margin-top: 8px;"></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <!-- Format nama img = pn_cust.jpg -->
            <img src="" id="img-pic" width="100%" height="550px">
        </div>
    </div>

    <!-- Footer -->
    <footer class="fixed-bottom">
        <div class="card-footer text-muted bg-dark h70">
            <div class="row">
                <div class="col-sm-1">
                    <a href="<?= BASEURL; ?>" class="btn btn-warning btn-block" title="Logout">
                        <img src="<?= BASEURL; ?>/img/logout.png" width="30">
                    </a>
                </div>
                <div class="col-sm-1" hidden>
                    <button id="btn-print" class="btn btn-warning btn-block" title="Print">
                        <img src="<?= BASEURL; ?>/img/print.png" width="30">
                    </button>
                </div>
                <div class="col-sm-1" hidden>
                    <a href="" id="btn-setting-qrcode" class="btn btn-warning btn-block" title="Set Margin" data-toggle="modal" data-target="#setting-margin">
                        <img src="<?= BASEURL; ?>/img/setting-margin.png" height="30">
                    </a>
                </div>
                <div class="col-sm-1">
                    <a href="" class="btn btn-warning btn-block" title="Pokayoke Data Part" data-toggle="modal" data-target="#pokayoke">
                        <img src="<?= BASEURL; ?>/img/cek.png" width="30">
                    </a>
                </div>
                <div class="col-sm-1">
                    <button id="btn-input" class="btn btn-warning btn-block" title="Input Qty OEM" data-toggle="modal" data-target="#input-oem-exp">
                        <img src="<?= BASEURL; ?>/img/input.png" height="30">
                    </button>
                </div>
                <?php if ($_SESSION['login']['usergroup'] != 'Operator') { ?>
                    <div class="col-sm-1" hidden>
                        <a href="<?= BASEURL; ?>/report/index" class="btn btn-warning btn-block" title="Report">
                            <img src="<?= BASEURL; ?>/img/report.png" height="30">
                        </a>
                    </div>
                <?php } ?>
                <div class="col-sm-1">
                    <button id="btn-delete" class="btn btn-warning btn-block" title="Delete Data">
                        <img src="<?= BASEURL; ?>/img/delete.png" height="30">
                    </button>
                </div>
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

    <!-- The Modal 1 : Pokayoke Data Part -->
    <div class="modal" id="pokayoke">
        <div class="modal-dialog-xl modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pokayoke Data Part</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="container-fluid modal-body">
                    <div class="row">
                        <div class="col-6">
                            <center>
                                <h5 class="font-weight-bold">Data Part Local</h5>
                            </center>
                            <h6>Barcode Customer</h6>
                            <input type="text" class="form-control" name="part-name-local" id="part-name-local" disabled>
                            <h6 class="mt-2" hidden>Part Number</h6>
                            <input type="text" class="form-control" name="pn-local" id="pn-local" disabled hidden>
                        </div>
                        <div class="col-6">
                            <center>
                                <h5 class="font-weight-bold">Data Part Shopping</h5>
                            </center>
                            <h6>Barcode Customer</h6>
                            <input type="text" class="form-control" name="part-name-shop" id="part-name-shop" disabled>
                            <h6 class="mt-2" hidden>Part Number</h6>
                            <input type="text" class="form-control" name="pn-shop" id="pn-shop" disabled hidden>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal 2 : Setting QR-code Label -->
    <div class="modal" id="setting-margin">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Setting QR-code Label</h3>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="container-fluid modal-body">
                    <div class="text-center">
                        <img src="<?= BASEURL; ?>/img/margin-qrcode.png" height="200px" alt="">
                    </div>
                    <form id="form-setting" action="" method="post">
                        <div class="form-group">
                            <label for="">Margin Left QR-code (pixel)</label>
                            <input type="number" class="form-control" name="left-qrcode" id="left-qrcode" required>
                        </div>
                        <div class="form-group">
                            <label for="">Margin Top QR-code (pixel)</label>
                            <input type="number" class="form-control" name="up-qrcode" id="up-qrcode" required>
                        </div>
                        <div class="form-group">
                            <label for="">Margin Left Label (pixel)</label>
                            <input type="number" class="form-control" name="left-label" id="left-label" required>
                        </div>
                        <div class="form-group">
                            <label for="">Margin Top Label (pixel)</label>
                            <input type="number" class="form-control" name="up-label" id="up-label" required>
                        </div>
                        <div class="form-group">
                            <label for="">Darkness</label>
                            <input type="number" class="form-control" name="darkness" id="darkness" required>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button id="test-print-qrcode" type="button" class="btn btn-primary">Test Print</button>
                    <button type="submit" class="btn btn-success" form="form-setting">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal 3 : Choose Qty Type -->
    <div class="modal" id="qty-type">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Pilih Tipe Qty Export</h3>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="container-fluid modal-body">
                    <div class="text-center">
                        <button id="qty-1L" class="btn btn-warning btn-lg btn-block mb-3" style="font-weight: bold;">1 L (200)</button>
                        <button id="qty-1N" class="btn btn-warning btn-lg btn-block" style="font-weight: bold;">1 N (400)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal 4 : Input Qty OEM & Export -->
    <div class="modal" id="input-oem-exp">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3 class="modal-title">Input Qty OEM</h3>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="container-fluid modal-body">
                    <form id="form-input" action="" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Qty OEM</label>
                                    <input type="number" class="form-control" name="val-qty-oem" id="val-qty-oem" min="0" required>
                                </div>
                                <div class="col-6">
                                    <label for="">Plus / Min</label>
                                    <input type="number" class="form-control" name="set-qty-oem" id="set-qty-oem">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Qty Export</label>
                                    <input type="number" class="form-control" name="val-qty-exp" id="val-qty-exp" min="0" required>
                                </div>
                                <div class="col-6">
                                    <label for="">Plus / Min</label>
                                    <input type="number" class="form-control" name="set-qty-exp" id="set-qty-exp">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" form="form-input">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Extension Javascript Program -->
    <div>
        <script src="<?= BASEURL; ?>/js/timer.js"></script>
        <script src="<?= BASEURL; ?>/js/home.js"></script>
    </div>
</body>

</html>