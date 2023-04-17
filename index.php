<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ARCHIVOS DE ESTILO -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="./css/validacion.css">
    <link rel="stylesheet" href="./css/footer.css">

    <link rel="shortcut icon" href="./img/ico/icono.png" type="image/x-icon">
    <title>Báscula Arduino</title>

</head>

<body>
    <header class="shadow-lg">

        <!-- MENU DE NAVEGACION -->
        <nav class="caja-sin-border navbar navbar-expand-lg mb-4 justify-content-center">
            <div class="container-fluid">
                <a class="justify-content-start logo-nav navbar-brand ms-4" href="./"><img src="./img/ico/logo.svg"
                        style="width: 12rem;"></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="w-100 navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item p-2">
                            <a class="nav-link active" aria-current="page" href="./">Inicio</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./dashboard/registro.php">Registro</a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link" href="./about.php">Acerca de</a>
                        </li>
                    </ul>
                    <a class="logo justify-content-end me-4" href="https://ismac.edu.ec" target="_blank"><img
                            class="logo" src="./img/soft.png" width="100px" style="filter: invert();"></a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container background">
        <!-- ENCABEZADO AQUI -->


        <form action="./controller/insertar_usuarios.php" method="POST" id="datos-usuario"
            onsubmit="return validacion();" novalidate>
            <div class="container-fluid row m-0 p-0">
                <!-- Pagina 1 -->
                <div class="caja bascula-arduino col-md-4 p-4 me-4 mb-4">
                    <h2>Listado de precios</h2>
                    <p>A continuación se presentan los precios de cada material reciclable</p>
                    <div id="materiales-select">
                        <ul class="list-group" id="lista-precios">
                            <li id="precios-cargando"
                                class='list-group-item d-flex justify-content-between align-items-left'>
                                <span class="align-text-bottom">Aquí se mostrarán el listado de precios.</span>
                                <span class="spinner-border" role="status"></span>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <div class="boton-administrar m-0 p-0" id="calculo_peso">
                            <a class="boton rojo" name="admin" id="admin" href="./dashboard/">Administrar</a>
                        </div>
                    </div>
                </div>
                <!-- PAGINA 2 -->
                <div class="caja bascula-arduino col-md p-4 mb-4" id="home">
                    <div class="content">
                        <h2 fw-light>Cálculo mediante báscula</h2>
                        <p>Seleccione el material que se está pesando:</p>
                        <div class="text-center pb-3">
                            <label for="material"> Material reciclable: </label>
                            <select class="form-control text-center" id='material' name='material'>
                            </select>
                            <br>
                            <h4>Valor báscula: </h4>
                            <h1 class="fs-2">
                                <section id="valorA"> <span class="spinner-border" role="status"></span> </section>
                            </h1>
                            <input type="button" onclick="resetBascula()" value="Resetear" class="boton azul">
                        </div>
                        <hr>
                        </hr>
                        <h3> Calcular el precio por su peso </h3>
                        <p> Para calcular el precio del material reciclado que está colocado en la báscula, seleccione
                            la
                            medida de peso y el material que se esta pesando </p>
                        <div class="row">
                            <div class="col">
                                <h3 class="text-center">Peso:</h3>
                                <input class="form-control text-center" placeholder="Click en calcular precio..."
                                    type="text" id="peso" name="peso" readonly="readonly">
                                <input type="button" value="Calcular precio" class="boton mt-3 me-2"
                                    onclick="calcular();">
                                <input type="button" value="Resetear" class="boton mt-3 azul" onclick="resetearValor()">

                            </div>
                            <div class="col">
                                <h3 class="text-center">Precio</h3>
                                <input class="form-control text-center" type="text" id="precio_total"
                                    readonly="readonly" class="box precio" name="precio_total" value="0.00 $">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SLIDER -->
            <div id="carouselExampleControls" class="carousel slide mh-25" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/recycle/1.jpg" class="d-block w-100 carousel-img">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/recycle/2.jpg" class="d-block w-100 carousel-img">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/recycle/3.jpg" class="d-block w-100 carousel-img">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Pagina 3 -->
            <div class="caja container-fluid-sm p-4 mt-4 mb-4 pb-5 formulario" id="registro">
                <div>
                    <fieldset class="mb-4">
                        <legend>
                            <h1>Registrar datos de cliente</h1>
                        </legend>

                        <div class="row g-2">

                            <!-- NOMBRE -->
                            <div class="col-md-6">
                                <label for="nombre">Nombre: </label>
                                <input class="form-control" type="text" class="box" id="nombre" name="nombre" required>
                                <div id="val-nombre" class="alert alert-danger error-nombre mt-1 mb-1 p-2 correcto"
                                    role="alert">
                                    <i class="red fas fa-exclamation-triangle"></i>
                                    <span class="fw-semibold">Coloque un nombre válido</span>
                                </div>
                            </div>

                            <!-- APELLIDO -->
                            <div class="col-md-6">
                                <label for="apellido">Apellido: </label>
                                <input class="form-control" type="text" class="box" id="apellido" name="apellido"
                                    required>
                                <div id="val-apellido" class="alert alert-danger error-nombre mt-1 mb-1 p-2 correcto"
                                    role="alert">
                                    <i class="red fas fa-exclamation-triangle"></i>
                                    <span class="fw-semibold">Coloque un apellido válido</span>
                                </div>
                            </div>

                            <!-- CEDULA -->
                            <div class="col-md-6">
                                <label for="cedula">Cédula: </label>
                                <input class="form-control" type="number" class="box" id="cedula" name="cedula"
                                    required>
                                <div id="val-cedula" class="alert alert-danger error-nombre mt-1 mb-1 p-2 correcto"
                                    role="alert">
                                    <i class="red fas fa-exclamation-triangle"></i>
                                    <span class="fw-semibold">Coloque su número de cédula sin guíones (10
                                        dígitos)</span>
                                </div>
                            </div>

                            <!-- TELEFONO -->
                            <div class="col-md-6">
                                <label for="celular">Teléfono: </label>
                                <input class="form-control" type="number" class="box" id="telefono" name="telefono"
                                    required>
                                <div id="val-telefono" class="alert alert-danger error-nombre mt-1 mb-1 p-2 correcto"
                                    role="alert">
                                    <i class="red fas fa-exclamation-triangle"></i>
                                    <span class="fw-semibold">Coloque su número telefónico sin espacios (10
                                        dígitos)</span>
                                </div>
                            </div>

                            <!-- CORREO -->
                            <div class="col-xxl-6">
                                <label for="correo">Correo: </label>
                                <input class="form-control" type="email" class="box" id="correo" name="correo" required>
                                <div id="val-correo" class="alert alert-danger error-nombre mt-1 mb-1 p-2 correcto"
                                    role="alert">
                                    <i class="red fas fa-exclamation-triangle"></i>
                                    <span class="fw-semibold">Coloque un correo válido</span>
                                </div>
                            </div>

                            <!-- DIRECCION -->
                            <div class="col-xxl-6">
                                <label for="direccion">Dirección <span class="fw-light">(Opcional)</span>: </label>
                                <textarea class="form-control" class="box" id="direccion" name="direccion"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <input type="submit" name="enviar" class="boton" id="enviar" value="Registrar Datos">
                </div>
            </div>
        </form>
    </div>
    <!-- Footer -->
    <div id="layoutAuthentication_footer" class="foot">
        <?php
            include "./layout/footer.php";
        ?>
    </div>
    <!-- End of Footer -->
</body>

<!-- JavaScript -->
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./js/calculo_precio.js" type="text/javascript"></script>
<script src="./js/materiales.js" type="text/javascript"></script>
<script src="./js/actualizar.js" type="text/javascript"></script>
<script src="./js/main.js" type="text/javascript"></script>

</html>