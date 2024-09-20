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
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            const rearCamera = cameras.find(camera => camera.facingMode === 'environment') || cameras[cameras.length - 1];
            scanner.start(rearCamera);

            // Mostrar el canvas
            document.getElementById('canvas').style.display = 'block';
            drawToCanvas(scanner.video); // Llamar a la función para dibujar
        } else {
            alert('No se encontró una cámara disponible');
            console.log('No se encontró una cámara disponible');
        }
    }).catch(function (e) {
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




function apagaCamara(){
    scanner.stop();
}