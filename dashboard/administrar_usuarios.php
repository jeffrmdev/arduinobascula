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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/css/dataTables.bootstrap5.min.css">

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

                <?php
                require('./layout/header.php');
            ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between pb-4">
                        <img src="../img/ico/logo.svg" style="width: 15rem;">
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h5 ms-3 mb-0 text-gray-800">Administrar clientes</h2>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- LISTA DE USUARIOS -->
                        <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lista de clientes</h6>
                                    <div>
                                        <input type="button" value="Agregar usuario" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onClick="opciones()">
                                    </div>
                                </div>

                                <div class="card-body p-3">
                                    <div class="table-responsive pt-1 pb-1" id="mostrarUsuarios">
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                require('./layout/footer.php');
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- New Material Modal -->
    <div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Agregar un nuevo usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" value="" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="col-form-label">Apellido:</label>
                            <input type="text" value="" id="apellido" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="col-form-label">Cédula:</label>
                            <input type="text" value="" id="cedula" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="col-form-label">Correo:</label>
                            <input type="email" value="" id="correo" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="col-form-label">Direccion:</label>
                            <input type="text" value="" id="direccion" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="materialList" class="col-form-label">Material:</label>
                            <select class="form-control form-select" id="materialList">

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pesoMat" class="col-form-label">Peso del material:</label>
                            <div class="input-group">
                                <input type="text" value="" id="pesoMat" class="form-control" placeholder="0.00">
                                <span class="input-group-text mb-3">gramos</span>
                            </div>    
                        </div>
                        <div class="mb-3">
                            <label for="precioVenta" class="col-form-label">Precio venta: </label>
                            <div class="input-group">
                                <span class="input-group-text mb-3">$</span>
                                <input type="text" value="" id="precioVenta" class="form-control" placeholder="" disabled readonly>
                            </div>
                        </div>
                        <button type="button" onclick="calcular();" class="btn btn-success">Calcular</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="agregarUsuario();" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="actualizarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Actualizar detalles de usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="user_id">
                        <div class="mb-3">
                            <label for="nombreUpdate" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreUpdate" value="" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="apellidoUpdate" class="col-form-label">Apellido:</label>
                            <input type="text" value="" id="apellidoUpdate" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="cedulaUpdate" class="col-form-label">Cédula:</label>
                            <input type="text" value="" id="cedulaUpdate" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="correoUpdate" class="col-form-label">Correo:</label>
                            <input type="email" value="" id="correoUpdate" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="direccionUpdate" class="col-form-label">Direccion:</label>
                            <input type="text" value="" id="direccionUpdate" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="materialListUpdate" class="col-form-label">Material:</label>
                            <select class="form-control form-select" id="materialListUpdate">

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pesoMatUpdate" class="col-form-label">Peso del material:</label>
                            <div class="input-group">
                                <input type="text" value="" id="pesoMatUpdate" class="form-control" placeholder="0.00">
                                <span class="input-group-text mb-3">gramos</span>
                            </div>    
                        </div>
                        <div class="mb-3">
                            <label for="precioVentaUpdate" class="col-form-label">Precio venta: </label>
                            <div class="input-group">
                                <span class="input-group-text mb-3">$</span>
                                <input type="text" value="" id="precioVentaUpdate" class="form-control" placeholder="" disabled readonly>
                            </div>
                        </div>
                        <button type="button" onclick="calcularUpdate();" class="btn btn-success">Calcular</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-actualizar" onclick="actualizarUsuario();" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" id="hidden_material">
                </div>
            </div>
        </div>
    </div>

    <!-- jsPDF -->
    <script src="../vendor/jspdf/jspdf.min.js"></script>
    <script src="../vendor/jspdf/jspdf.plugin.autotable.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/sweetalert2/dist/sweetalert2.all.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>


    <!-- Datatables -->
    <script type="text/javascript" src="../vendor/DataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../vendor/DataTables/js/dataTables.bootstrap5.min.js"></script>

    <!-- CRUD -->
    <script src="./js/usuarios.js"></script>


</body>

</html>