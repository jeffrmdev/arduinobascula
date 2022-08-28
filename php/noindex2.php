<?php

    include 'conexion_database.php';   
    
    if(mysqli_connect_errno()){
        echo "No se ha podido establecer conexión con la base de datos: " . mysqli_connect_error();
    }
    echo '<script src ="./js/calculo_precio_material.js" type="text/javascript"></script>';
    echo '<script src ="./js/actualizar.js" type="text/javascript"></script>';
    echo '<script defer src ="./js/main.js" type="text/javascript"></script>';
    $query = "SELECT * FROM precio_materiales";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src=".\ico\js\all.js" crossorigin="anonymous"></script>

    <!-- ARCHIVOS DE ESTILO 
    <link rel="stylesheet" href="./css/footer.css">-->
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="./css/table.css"> 

    <title>Báscula Arduino</title>

</head>

<body>

    <!-- ENCABEZADO -->
    <header class="shadow-lg">
        <nav class="navbar">
            <ul class="nav ps-5">
                <li class="nav-item active"><a class="text-light nav-link" href="#home">Inicio<span
                            class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="text-light nav-link" href="#registro">Registro</a></li>
                <li class="nav-item"><a class="text-light nav-link" href="#about">Acerca de</a></li>
            </ul>
            <a class="nav-brand justify-content-end pe-5 m-1" href="#"><img class="logo" src="./img/soft.png" width="100px"></a>
        </nav>
    </header>

    <!-- FORMULARIO -->
    <form action="insertar_usuarios.php" method="POST" id="datos-usuario" onsubmit="validacionDatos()">
        <div class="container-fluid row m-0 p-0">
            <!-- Pagina 1 -->
            <div class="bascula-arduino col-xl p-5" id="home">
                <div class="content">
                    <h1>Báscula con Arduino </h1>
                    <p>Seleccione el material que se está pesando:</p>
                    <div class="text-center">
                        <section id="materiales">
                            <label for="material"> Material reciclable: </label>
                            <select class='material-select form-control m-auto text-center' id='material'
                                name='material'>
                                <?php 
                            if($result){
                            while($row = mysqli_fetch_array($result)){
                                $precio = $row["precio"];
                                $materiales = $row["material"];
                                $id = $row["id"];
                            echo "<option value=" . $precio . ">" . $materiales . "</option>";
                            }
                        }?>
                            </select>
                        </section>
                        <br>
                        <h4>Valor de la báscula: </h4>
                        <h1 class="fs-2">
                            <section id="valorA"> 0 </section>
                        </h1>
                    </div>
                    <hr>
                    </hr>
                    <h3> Calcular el precio por su peso </h3>
                    <p> Para calcular el precio del material reciclado que se ha colocado en la báscula, seleccione la
                        medida de peso y el material que se esta pesando </p>
                    <div class="d-flex justify-content-center">
                        <input type="button" value="Calcular precio" class="boton justify-content-center"
                            onclick="calcular()">
                    </div>
                    <br>
                    <div>
                        <h3 class="text-center">Precio</h3>
                        <input class="form-control text-center" type="text" id="precio_total" readonly="readonly"
                            class="box precio" name="precio_total" value=0>
                    </div>
                </div>
            </div>
            <!-- PAGINA 2 -->
            <div class="bascula-arduino col-sm p-5">
                <h2>Listado de precios</h2>
                <p>A continuación se presentan los precios de cada material reciclable</p>
                <div class="d-flex justify-content-center">
                    <table class="precios_referenciales shadow-lg">
                        <caption> Precios referenciales respecto a material reciclado </caption>
                        <tr class="abajo">
                            <th>Material</th>
                            <th>Precio</th>
                        </tr>
                        <?php 
                            $query = "SELECT * FROM precio_materiales";
                            $result = mysqli_query($con, $query); 
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td class='separador'>" . $row[1] . '</td>';
                                    echo '<td>' . $row[2] . '</td>';
                                echo "</tr>";
                                }     
                            }?>
                        <tr>
                            <td class="aviso" colspan="2">Pueden variar de acuerdo a las condiciones del mercado y la
                                calidad de material entregado al gestor</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    <div class="boton-administrar m-0 p-0" id="calculo_peso">
                        <a class="boton rojo" name="admin" id="admin" href="ajustar_precios.php">Administrar</a>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        </hr>

        <!-- Pagina 3 -->
        <div class="container-fluid-sm m-5 formulario md-auto" id="registro">
            <div>
                <fieldset>
                    <legend>
                        <h1>Registrar datos</h1>
                    </legend>

                    <div class="row g-2">
                        <div class="col verificador v-nombre">
                            <div class="form-floating mb-3">
                            <span id="validador" class="validador position-absolute top-50 translate-middle danger fa-solid fa-circle-exclamation"></span> 
                                <input class="form-control" type="text" class="box" id="nombres" name="nombres" required>
                                <label for="nombres">Nombre: </label>
                            </div>
                        </div>
                        <div class="col verificador v-apellido">
                            <div class="form-floating mb-3">
                            <span class="validador position-absolute top-50 translate-middle danger fa-solid fa-circle-exclamation"></span>
                                <input class="form-control" type="text" class="box" id="apellido" name="apellido" required>
                                <label for="apellido">Apellido: </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-column">
                        <div class="form-floating mb-3 verificador v-cedula">
                        <span class="validador position-absolute top-50 translate-middle danger fa-solid fa-circle-exclamation"></span>
                            <input class="form-control" type="text" class="box" id="cedula" name="cedula" required>
                            <label for="cedula">Cédula: </label>
                        </div>
                        <div class="form-floating mb-3 verificador v-correo">
                        <span class="validador position-absolute top-50 translate-middle danger fa-solid fa-circle-exclamation"></span>
                            <input class="form-control" type="email" class="box" id="correo" name="correo" required>
                            <label for="correo">Correo: </label>
                        </div>

                        <div class="form-floating mb-3 verificador v-telefono">
                        <span class="validador position-absolute top-50 translate-middle danger fa-solid fa-circle-exclamation"></span>
                            <input class="form-control" type="text" class="box" id="celular" name="celular" required>
                            <label for="celular">Teléfono: </label>

                        </div>
                        <div class="form-floating mb-3 verificador v-direccion">
                            <textarea class="form-control" class="box" id="direccion" name="direccion"
                                placeholder="Ingrese su dirección (opcional)"></textarea>
                            <label for="direccion">Dirección: </label>

                        </div>
                    </div>
                    <div class="errors"></div>
                </fieldset>
                <input type="submit" class="boton" name="enviar" id="enviar" value="Registrar Datos">
            </div>
        </div>
    </form>
    <footer class="color-footer text-center text-lg-start">
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

            <div class="mx-auto">
                <div class="me-0 d-none d-lg-block text-center">
                    <p>
                        <span>Atento a nuestras redes sociales:</span>
                    </p>
                </div>
                <a href="" class="m-3 text-reset"><i class="redes fab fa-facebook-f"></i></a>
                <a href="" class="m-3 text-reset"><i class="redes fab fa-twitter"></i></a>
                <a href="" class="m-3 text-reset"><i class="redes fab fa-instagram"></i></a>
                <a href="" class="m-3 text-reset"><i class="redes fab fa-linkedin"></i></a>
            </div>
        </section>
        <section class="footer">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>Company name</h6>
                        <p>Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.</p>
                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4"> Useful links</h6>
                        <li><a href="#!" class="text-reset">Pricing</a></li>
                        <li><a href="#!" class="text-reset">Settings</a></li>
                        <li><a href="#!" class="text-reset">Orders</a></li>
                        <li><a href="#!" class="text-reset">Help</a></li>
                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <li><i class="fas fa-home me-3"></i> New York, NY 10012, US</li>
                        <li><i class="fas fa-envelope me-3"></i></li>
                        <li><i class="fas fa-phone me-3"></i> + 01 234 567 88</li>
                        <li><i class="fas fa-print me-3"></i> + 01 234 567 89</li>
                    </div>
                </div>
            </div>
        </section>
        <div class="desarrollador text-center p-2">
            <p>© 2022 Copyright:
                Desarrollado por Jefferson Rios</a>
        </div>
    </footer>
</body>

</html>