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
            // Busca la cámara trasera
            const rearCamera = cameras.find(camera => camera.facing === 'environment');
            if (rearCamera) {
                scanner.start(rearCamera);
                document.getElementById('canvas').style.display = 'block';
                drawToCanvas(scanner.video); 
            } else {
                console.error('No se encontró una cámara trasera. Usando la cámara frontal.');
                scanner.start(cameras[0]); // Inicia la cámara frontal si no hay trasera
            }
        } else {
            console.error('No se encontraron cámaras.');
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

    // Dibuja el video en el canvas
    setInterval(() => {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }, 100); // Dibuja cada 100ms (10fps)
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