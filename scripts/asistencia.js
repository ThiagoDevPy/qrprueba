var scanner = new Instascan.Scanner({
    continuous : true,
    video : document.getElementById('preview'),
    mirror: false,
    captureImage: false,
    backgroundScan: false,
    refractoryPeriod: 5000,
    scanPeriod: 5
});


function iniciaCamara(){
    Instascan.Camera.getCameras().then(function (cameras){
        if (cameras.length >0) {
            scanner.start(cameras[cameras.length - 1]);
        } else {
            alert('No se encontro una camara disponible');
            console.log('No se encontro una camara disponible');
        }
    }).catch(function (e){
        console.error(e);
    });
}


function apagaCamara(){
    scanner.stop();
}