<?php
session_start(); //cookis para iniciar secion
if (empty($_SESSION['id'])) {
    header('location: ./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- descripcion de caracteres -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/ico/icono.png" type="image/x-icon">
    <!--funcion para colocar un icono en la pestaña del  navagador -->

    <title>Dashboard B - All in One</title>

    <!-- dar estilos al sitio web -->
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                    <div class="card shadow">
                        <div class="card-header d-flex flex-row justify-content-between align-items-center">
                            <p class="font-weight-bold text-primary m-0">Lista de roles</p>
                            <div>
                                <input type="button" value="Agregar rol" id="mostrarModal"s class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#agregarRol">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive pt-1 pb-1" id="mostrarRoles">
                                <div class="container-fluid p-5 text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                </div>
            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <div id="layoutAuthentication_footer" class="foot">
                <?php
                include "./layout/footer.php";
            ?>
            </div>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- New Material Modal -->
    <div class="modal fade" id="agregarRol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Detalles de rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="rol" class="col-form-label">Tipo de rol: </label>
                            <input type="text" class="form-control" id="rol" value="" placeholder="Ejemplo: Secretaria">
                        </div>
                        <div class="mb-3">
                            <label for="codigo" class="col-form-label">Código: </label>
                            <input type="text" value="" id="codigo" class="form-control" placeholder="Ejemplo: 1a2b3">
                            <input type="hidden" id="id_rol">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="agregarRol();" id="guardar" class="btn btn-primary">Guardar</button>
                    <button type="button" onclick="actualizarRol();" id="actualizar" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/sweetalert2/dist/sweetalert2.all.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Código de roles -->
    <script src="./js/roles.js"></script>


</body>

</html>
