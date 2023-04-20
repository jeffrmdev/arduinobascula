<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location: ./login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/ico/icono.png" type="image/x-icon">

    <title>Dashboard B - All in One</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/css/dataTables.bootstrap5.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        require('./layout/menu.php');
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php 
                    require('./layout/header.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between pb-4">
                        <img src="../img/ico/logo.svg" style="width: 15rem;">
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h5 ms-3 mb-0 text-gray-800">Inicio Dashboard B. - All in One </h2>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Tarjeta con información -->
                        <a class="col-xl-3 col-md-6 mb-4" href="./administrar_usuarios.php">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <span class="items" id="i1"></span>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="it1"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Tarjeta con información -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <span class="items" id="i2"></span>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="it2"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-square fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tarjeta con información -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <span class="items" id="i3"></span>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <span id="it3"></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-recycle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
    <script src="./js/estadisticas.js"></script>

    <!-- Tarjetas -->
    <script src="./js/tarjetas.js"></script>


</body>

</html>