<?php
session_start(); //cookis para iniciar secion
if (empty($_SESSION['id'])) {
    header('location: ./login.php');
}

include '../model/conexion_database.php';

$query = "SELECT * FROM login_usuarios where id_usuario = '$_SESSION[id]'";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
        $id = $row[0];
        $username = $row[1];
        $nombre = $row[2];
        $apellido = $row[3];
        $id_codigo_miembro = $row[4];
        $correo = $row[5];
}
$q = "SELECT rol_miembro, id FROM codigo_miembros WHERE id = $id_codigo_miembro";

$result = mysqli_query($con, $q);
while ($row = mysqli_fetch_array($result)) {
    $rol = $row[0];
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
                <div class="container-fluid mb-5">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between pb-4">
                        <img src="../img/ico/logo.svg" style="width: 15rem;">
                    </div>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h5 ms-3 mb-0 text-gray-800">Configuración de perfil</h2>
                    </div>
                    <div class="card shadow">
                        <p class="card-header font-weight-bold text-primary m-0">Perfil de <?php echo $rol;?></p>
                        <div class="card-body">
                            <div class="container" id="mensaje">
                            </div>
                            <div class="container flex-row d-flex align-items-center justify-content-between">
                                <div class="col-6 gy-2 d-flex flex-column align-items-center">
                                    <img class="img-thumbnail" width="300px" src="./img/imagen-usuario.png"
                                        alt="...">
                                </div>
                                <div class="ms-3 col-6">
                                    <label class="form-label" for="nombre">Nombre:</label>
                                    <input class="form-control col" type="text" id="nombre" value="<?php echo $nombre; ?>" name="nombre">
                                    <br>
                                    <label class="form-label" for="contraseña">Apellido:</label>
                                    <input class="form-control col" type="text" value="<?php echo $apellido; ?>" id="apellido" name="apellido">
                                    <br>
                                    <label class="form-label" for="correo">Correo electrónico:</label>
                                    <input class="form-control col" type="email" value="<?php echo $correo; ?>" id="correo" name="correo">
                                    <br>
                                    <label class="form-label" for="bio">Nombre de Usuario:</label>
                                    <input class="form-control col" type="text" value="<?php echo $username;?>" id="username" name="username">
                                    <input class="hidden" type="hidden" id="id" value="<?php echo $id;?>" name="id">
                                </div>
                            </div>
                            <div class="row justify-content-md-center mt-5 mb-3">
                                <input class="col-6 btn btn-primary" type="button" onClick="guardar(<?php echo $id; ?>)" value="Guardar cambios">
                            </div>
                        </div>
                    </div>
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

    <!-- Tarjetas -->
    <script src="./js/perfil.js"></script>


</body>

</html>