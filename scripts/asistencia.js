var scanner = new Instascan.Scanner({
    continuous : true,
    video : document.getElementById('preview'),
    mirror: false,
    captureImage: false,
    backgroundScan: false,
    refractoryPeriod: 5000,
    scanPeriod: 5
});





function iniciaCamara() {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            let rearCamera = cameras.find(camera => camera.id.includes("back") || camera.id.includes("rear")) || cameras[0];
            scanner.start(rearCamera);
        } else {
            alert('No se encontró una cámara');
        }
    }).catch(function(e) {
        console.error(e);
    });
}


function drawToCanvas(video) {
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    canvas.width = 300; // Asegúrate de que el canvas tenga el mismo tamaño
    canvas.height = 300;

    function draw() {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        requestAnimationFrame(draw); // Llama a draw nuevamente en el siguiente frame
    }

    draw(); // Inicia el ciclo de dibujo
}




scanner.addListener('scan', function(content) {
    console.log("Contenido escaneado: ", content);

    // Aquí puedes verificar el contenido del QR
    if (content.includes('guardardatos.php')) {
        // Si la URL contiene "guardarusuario.php", redirigir
        window.location.href = content; // Redirigir a la URL escaneada
    } else {
        alert('URL no válida o no reconocida: ' + content);
    }
});


function apagaCamara(){
    scanner.stop();
}