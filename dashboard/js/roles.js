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

    if (rol == '' && codigo == '') {
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

            }

        })
    }
}

function obtenerDetalles(id) {
    option = "mostrar"
    //Muestro la pantalla de detalles y oculto el boton de guardado
    $('#agregarRol').modal("show");
    $('#actualizar').show();
    $('#guardar').hide();


    let rol = $('#rol').val();
    let codigo = $('#codigo').val();
    let id_rol = $('#id_rol').val();

    $.ajax({
        url: './php/config_roles.php',
        type: 'GET',
        data: {
            rol: rol,
            codigo: codigo,
            id: id_rol,
        }

    })

}
mostrarRoles();