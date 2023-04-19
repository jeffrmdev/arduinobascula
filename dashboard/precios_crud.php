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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../vendor/DataTables/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">

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

                <!-- Top bar -->
                <?php
                require('./layout/header.php');
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between pb-4">
                        <img src="../img/ico/logo.svg" style="width: 15rem;">
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-7">
                            <!-- EDICION DE PRECIOS DE MATERIALES -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lista de precios</h6>
                                    <div>
                                        <input type="button" value="Agregar material" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarMaterial">
                                    </div>
                                </div>

                                <div class="card-body p-3">
                                    <div class="table-responsive pt-1 pb-1" id="mostrarMateriales">
                                        <div class="container-fluid p-5 text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Cargando</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require('./layout/footer.php');
            ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- New Material Modal -->
    <div class="modal fade" id="agregarMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Agregar un nuevo material</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="material" class="col-form-label">Nombre material:</label>
                            <input type="text" class="form-control" id="material" value="" placeholder="Ejemplo: baterías">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="col-form-label">Precio:</label>
                            <input type="number" min="0.00" max="10000.00" step="0.01" value="" id="precio" class="form-control" placeholder="0.00">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="agregarMaterial();" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="actualizarMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Actualizar detalles</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="materialupdate" class="col-form-label">Nombre material:</label>
                            <input type="text" class="form-control" id="materialupdate" placeholder="Ejemplo: baterías">
                        </div>
                        <div class="mb-3">
                            <label for="precioupdate" class="col-form-label">Precio:</label>
                            <input type="number" min="0.00" max="10000.00" step="0.01" id="precioupdate" class="form-control" placeholder="0.00">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-actualizar" onclick="actualizarMaterial();" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" id="hidden_material">
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- CRUD listado de precios -->
    <script src="./js/materiales.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" src="../vendor/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../vendor/DataTables/js/dataTables.bootstrap5.min.js"></script>




</body>

</html>