$(document).ready(function () {
    $("#mensaje").hide();
})


function guardar(id) {
    let nombre = document.getElementById("nombre").value
    let apellido = document.getElementById("apellido").value
    let correo = document.getElementById("correo").value
    let username = document.getElementById("username").value

    $.ajax({
        url: "./php/config_perfil.php",
        type: "POST",
        data: {
            id: id,
            nombre: nombre,
            apellido: apellido,
            correo: correo,
            username: username,
        },
        success: function (data) {
            let mensaje = document.getElementById("mensaje");
            $("#mensaje").show();
            mensaje.innerHTML = `
            <div class="alert alert-primary" role="alert">
                ${data}
            </div>`;
            $("#mensaje").fadeOut(2000, function(){
                $("#mensaje").hide();
            })
            //setTimeout(() => {$("#mensaje").hide().fadeOut("slow", function(){})}, 2000);
        }
    })
}