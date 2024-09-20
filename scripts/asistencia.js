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
            document.getElementById('preview').style.display = 'block'; // Mostrar el video
        } else {
            alert('No se encontró una cámara disponible');
            console.log('No se encontró una cámara disponible');
        }
    }).catch(function (e) {
        console.error(e);
    });
}



function apagaCamara(){
    scanner.stop();
}