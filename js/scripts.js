function registrarUsuario() {
    var nombre = document.getElementById('nombre').value;
    var apellido = document.getElementById('apellido').value;
    var cedula = document.getElementById('cedula').value;
    var carrera = document.getElementById('carrera').value;
    var telefono = document.getElementById('telefono').value;


    console.log(nombre + " " + apellido + " " + " " + cedula + " " + carrera);


    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'registrarusuario.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                window.location.href = 'login.php';
            }

        } else {
            alert('Error en la solicitud.');
        }
    };

    xhr.send(
        'nombre=' + encodeURIComponent(nombre) +
        '&apellido=' + encodeURIComponent(apellido) +
        '&cedula=' + encodeURIComponent(cedula) +
        '&carrera=' + encodeURIComponent(carrera)+
        '&telefono=' + encodeURIComponent(telefono)
    );

}





function login() {
    // Obtener los valores del formulario
    var cedula = document.getElementById('cedula').value;
   
   
    // Crear una instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'validarlogin.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   
    // Configurar el callback para manejar la respuesta
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
               var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    window.location.href = 'index.php'; // Redirigir al dashboard
                } else {
                    alert("Datos Incorrectos");
                }
            } else {
                document.getElementById('message').textContent = 'Error en la solicitud.';
            }
        }
    };
   
    // Enviar los datos del formulario
    xhr.send('cedula=' + encodeURIComponent(cedula) );
   }






    