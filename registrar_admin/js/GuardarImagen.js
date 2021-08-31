function load_image(origin, dest) {
    function mostrarImagen(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = document.getElementById(origin);
            img.src = event.target.result;
        }
        reader.readAsDataURL(file);
    }

    function init() {
        var inputFile = document.getElementById(dest);
        if (inputFile) {
            inputFile.addEventListener('change', mostrarImagen, false);
        }
    }

    window.addEventListener('load', init, false);

}

load_image('img_a', 'FotoA');
load_image('img_b', 'FotoB');

