const { jsPDF } = window.jspdf;
const listado = document.getElementById("materialList");
const listadoUpdate = document.getElementById("materialListUpdate");

let option = "";

function opciones() {
    $.ajax({
        url: './../php/materiales.php',
        type: 'GET',
        success: function (response) {
            const materiales = JSON.parse(response);
            let template = '';

            materiales.forEach(material => {
                template += `<option class="form-control" name="materiales" id="${material.material_id}" value="${material.material_id}_${material.precio}">
                ${material.materiales} </option>`;
            });

            listado.innerHTML = template;
            listadoUpdate.innerHTML = template;
        }
    });
};

function calcular() {
    const pesoMaterial = document.getElementById("pesoMat").value;
    let va = listado.value.split('_');
    let valor = parseFloat(va[1]);
    let total = Math.floor(pesoMaterial) * valor;
    let final = (total / 1000).toFixed(2);
    document.getElementById('precioVenta').value = final;
}

function calcularUpdate() {
    const pesoMaterial = document.getElementById("pesoMatUpdate").value;
    let va = listadoUpdate.value.split('_');
    let valor = parseFloat(va[1]);
    let total = Math.floor(pesoMaterial) * valor;
    let final = (total / 1000).toFixed(2);
    document.getElementById('precioVentaUpdate').value = final;
}

//CREAD MATERIALES
function agregarUsuario() {
    option = "insertar";
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let cedula = document.getElementById("cedula").value;
    let correo = document.getElementById("correo").value;
    let direccion = document.getElementById("direccion").value;
    let id_material = listado.value.split("_");
    let mat = id_material[0];
    let peso = document.getElementById("pesoMat").value;
    let precio = document.getElementById("precioVenta").value;
    let ver = true;

    if (nombre == '' || apellido == '' || cedula == '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No deje los campos vacíos',
        })
        ver = false;
    }

    if (ver) {
        $.ajax({
            url: './php/usuarios.php',
            type: 'POST',
            data: {
                nombre: nombre,
                apellido: apellido,
                cedula: cedula,
                correo: correo,
                direccion: direccion,
                material: mat,
                peso: peso,
                precio: precio,
                opcion: option
            },
            success: function (data, status) {
                $("#agregarUsuario").modal("hide")
                $('#nombre').val("");
                $('#apellido').val("");
                $('#cedula').val("");
                $('#correo').val("");
                $('#direccion').val("");
                $('#pesoMat').val("");
                $('#precioVenta').val("");
                mostrarUsuario();
                notificacionAgregarUsuario()
            },
        })
    }
}

//READ MATERIALES
function mostrarUsuario() {
    $.ajax({
        url: './php/mostrar_todos_los_usuarios.php',
        type: 'GET',
        success: function (response) {
            let i = 1
            let usuarios = document.getElementById("mostrarUsuarios")
            const totalUsuarios = JSON.parse(response)
            let template = `
                <table id="lista_usuarios" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Material</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Precio</th>
                            <th class="text-center" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="container-fluid">`;

            totalUsuarios.forEach(usuario => {
                template += `
                    <tr> 
                        <th scope="row">${i++}</th>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.apellido}</td>
                        <td>${usuario.cedula}</td>
                        <td>${usuario.correo}</td>
                        <td>${usuario.direccion}</td>
                        <td>${usuario.material}</td>
                        <td>${usuario.peso} <span>g</span></td>
                        <td>${usuario.precio} <span>$</span></td>
                        <td class="text-center">
                            <button class="btn btn-dark btn-sm" onclick="obtenerDetalles('${usuario.id}');opciones()">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarMaterial('${usuario.id}')">Eliminar</button>
                            <button class="btn btn-success btn-sm" onclick="imprimir('${usuario.id}')">Imprimir</button>
                        </td>
                    </tr>`;
            })
            template += `
                    </tbody>
                </table>`;

            usuarios.innerHTML = template;
        }
    })
}

//UPDATE MATERIALES
function actualizarUsuario() {
    option = "actualizar";
    let nombreUpdate = document.getElementById("nombreUpdate").value;
    let apellidoUpdate = document.getElementById("apellidoUpdate").value;
    let user_id = document.getElementById("user_id").value;
    let cedulaUpdate = document.getElementById("cedulaUpdate").value;
    let correoUpdate = document.getElementById("correoUpdate").value;
    let direccionUpdate = document.getElementById("direccionUpdate").value;
    let id_materialUpdate = listadoUpdate.value.split("_");
    let matUpdate = id_materialUpdate[0];
    let pesoUpdate = document.getElementById("pesoMatUpdate").value;
    let precioUpdate = document.getElementById("precioVentaUpdate").value;
    let ver = true;
    console.log(nombreUpdate);

    if (nombreUpdate == '' && apellidoUpdate == '' && cedulaUpdate == '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No deje los campos vacíos',
        })
        ver = false;
    }

    if (ver) {
        $.ajax({
            url: './php/usuarios.php',
            type: 'POST',
            data: {
                id: user_id,
                nombre: nombreUpdate,
                apellido: apellidoUpdate,
                cedula: cedulaUpdate,
                correo: correoUpdate,
                direccion: direccionUpdate,
                material: matUpdate,
                peso: pesoUpdate,
                precio: precioUpdate,
                opcion: option
            },
            success: function (data, status) {
                $("#actualizarUsuario").modal("hide")
                $('#nombreUpdate').val("");
                $('#apellidoUpdate').val("");
                $('#cedulaUpdate').val("");
                $('#correoUpdate').val("");
                $('#direccionUpdate').val("");
                $('#pesoMatUpdate').val("");
                $('#precioVentaUpdate').val("");
                $('#user_id').val("");
                mostrarUsuario();
                notificacionActualizarUsuario()
            },
            beforeSend: () => {
                mostrarUsuario();
            },
        })
    }
}

//DELETE MATERIALES
function eliminarMaterial(id) {
    option = "eliminar";
    let estado = false;
    Swal.fire({
        title: '¿Quiere eliminar este material?',
        text: "No se podrá recuperar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DA0000',
        cancelButtonColor: '#332DB9',
        confirmButtonText: 'Si, eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            let estado = true
            eliminar(estado)
        }
    })
    function eliminar(st) {
        if (st) {
            $.ajax({
                url: "./php/usuarios.php",
                type: "POST",
                data: {
                    idUsuario: id,
                    opcion: option
                },
                success: function (data, status) {
                    mostrarUsuario();
                    notificacionEliminar();
                }
            })
        }
    }
}

//RELLENAR CAMPOS PARA ACTUALIZAR MATERIALES
function obtenerDetalles(id_user) {
    option = "leer";
    $("#actualizarUsuario").modal("show")

    $.ajax({
        url: "./php/usuarios.php",
        type: "POST",
        data: {
            id: id_user,
            opcion: option
        },
        success: function (data, status) {
            let datos = JSON.parse(data);
            $('#user_id').val(datos.id);
            $('#nombreUpdate').val(datos.nombre);
            $('#apellidoUpdate').val(datos.apellido);
            $('#cedulaUpdate').val(datos.cedula);
            $('#correoUpdate').val(datos.correo);
            $('#direccionUpdate').val(datos.direccion);
            $('#pesoMatUpdate').val(datos.peso);
            $('#precioVentaUpdate').val(datos.precio);
            $(document).ready(function () {
                $(`#materialListUpdate > option[id='${datos.id_material}']`).prop('selected', 'selected');
            })
        }
    })
}

//NOTIFICACIONES SWEETALERT
function notificacionAgregarUsuario() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Se ha agregado un nuevo material'
    })
}

//NOTIFICACION ACTUALIZACION DE USUARIO
function notificacionActualizarUsuario() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Se ha actualizado el usuario'
    })
}

//NOTIFICACION ELIMINAR USUARIO
function notificacionEliminar() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'error',
        title: 'Se ha eliminado a el usuario'
    })
}

//IMPRIMIR DOCUMENTO PDF
function imprimir(id_user){
    option = "leer";
    $.ajax({
        url: "./php/usuarios.php",
        type: "POST",
        data: {
            id: id_user,
            opcion: option
        },
        success: function (data, status) {
            const datos = JSON.parse(data);
            const doc = new jsPDF();
            doc.setFontSize(30); doc.text("FACTURA", 20, 30);
            doc.setFontSize(20); doc.text('Detalles de factura', 20, 50);
            doc.setFontSize(16); doc.text('Datos personales:', 20, 67);  
            doc.setFontSize(10); doc.text("Nombre: " + datos.nombre.toString().toUpperCase(), 20, 75);
            doc.text("Apellido: " + datos.apellido.toString().toUpperCase(),20, 80);
            doc.text("Cédula: " + datos.cedula.toString(), 20, 85);
            doc.text("Correo: " + datos.correo.toString(), 20, 90);
            doc.text("Dirección: " + datos.direccion, 20, 95);
            doc.setFontSize(16); doc.text('Detalle materiales: ', 20, 110);
            doc.autoTable({
                margin: {top:115, left:20},
                styles: {},
                head: [['Tipo material', 'Peso material', 'Precio']],
                body: [
                  [datos.materiales, datos.peso + " g", datos.precio + " $"],
                ],
              })
            
            doc.save("Detalles de factura de " + datos.cedula);
            /*$('#user_id').val(datos.id);
            $('#nombreUpdate').val(datos.nombre);
            $('#apellidoUpdate').val(datos.apellido);
            $('#cedulaUpdate').val(datos.cedula);
            $('#correoUpdate').val(datos.correo);
            $('#direccionUpdate').val(datos.direccion);
            $('#pesoMatUpdate').val(datos.peso);
            $('#precioVentaUpdate').val(datos.precio);
            $(document).ready(function () {
                $(`#materialListUpdate > option[id='${datos.id_material}']`).prop('selected', 'selected');
            })*/
        }
    })
}

//NOTIFICACION PARA
mostrarUsuario()