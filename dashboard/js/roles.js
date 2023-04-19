let option = "";

function mostrarRoles() {
    $.ajax({
        url: './php/config_roles.php',
        type: 'GET',
        success: (response) => {
            let i = 1;
            const tabla = document.getElementById("mostrarRoles");
            const roles = JSON.parse(response);
            let template = `
                    <table id="lista_usuarios" class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Código</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="container-fluid">`;
            roles.forEach(rol => {
                template +=
                    `<tr>
                        <td>${i++}</td>
                        <td>${rol.rol}</td>
                        <td>${rol.codigo}</td>
                        <td class="text-center">
                            <button class="btn btn-primary" onClick="obtenerDetalles(${rol.id})">Editar</button>
                            <button class="btn btn-danger" onClick="eliminarRol(${rol.id})">Eliminar</button>
                        </td>
                    </tr>`

            });

            template += `
            </tbody>
            </table>`;

            tabla.innerHTML = template;

        }
    })
}

function agregarRol() {
    let ver = true;
    option = "agregar"
    let rol = document.getElementById("rol").value
    let codigo = document.getElementById("codigo").value

    if (rol.length == 0 || codigo.length == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No deje los campos vacíos',
        })
        ver = false;
    }
    if (ver) {
        $.ajax({
            url: './php/config_roles.php',
            type: 'POST',
            data: {
                rol: rol,
                codigo: codigo,
                opcion: option,
            },
            success: function (data, status) {
                $('#rol').val('');
                $('#codigo').val('');
                $('#agregarRol').modal('hide');
                mostrarRoles();
            }

        })
    }
}

function actualizarRol() {
    let ver = true;
    option = "actualizar"
    let rol = document.getElementById("rol").value
    let codigo = document.getElementById("codigo").value
    let id = document.getElementById("id_rol").value

    if (rol.length == 0 || codigo.length == 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No deje los campos vacíos',
        })
        ver = false;
    }
    if (ver) {
        $.ajax({
            url: './php/config_roles.php',
            type: 'POST',
            data: {
                rol: rol,
                codigo: codigo,
                id:id,
                opcion: option,
            },
            success: function (data, status) {
                $('#rol').val('');
                $('#codigo').val('');
                $('#agregarRol').modal('hide');
                mostrarRoles();
            }

        })
    }
}

function eliminarRol(id) {
    option = "eliminar";
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
    function eliminar(estado) {
        if (estado) {
            $.ajax({
                url: "./php/config_roles.php",
                type: "POST",
                data: {
                    id: id,
                    opcion: option
                },
                success: function (data, status) {
                    mostrarRoles();
                    notificacionEliminar();
                }
            })
        }
    }
}

function obtenerDetalles(id) {
    option = "mostrar"
    //Muestro la pantalla de detalles y oculto el boton de guardado
    $(document).ready(() => {
        $('#agregarRol').modal("show");
        $('#actualizar').show();
        $('#guardar').hide();
    })
    $.ajax({
        url: './php/config_roles.php',
        type: 'POST',
        data: {
            id: id,
            opcion: option,
        },
        success: function (data) {
            let datos = JSON.parse(data);
            $('#rol').val(`${datos.rol_detalles}`);
            $('#codigo').val(`${datos.codigo_detalles}`);
            $('#id_rol').val(`${datos.id_detalles}`);
        }
    })
}


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

mostrarRoles();

$(document).ready(() => {
    $("#mostrarModal").click(()=>{
        $('#actualizar').hide();
        $('#guardar').show();
        $('#rol').val('');
        $('#codigo').val('');
        $('#id_rol').val('');
    })
})