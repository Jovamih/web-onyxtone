//Función para cargar las categorías al campo "select".
function cargar_categorias() {
    //Inicializamos el array.
    var array = ["Polos", "Pantalones", "Poleras", "Conjuntos", "Otros"];
    //Ordena el array alfabeticamente.
    array.sort();
    //Pasamos a la funcion addOptions(el ID del select, las categorias cargadas en el array).
    addOptions("Categoria", array);
}

//Función para agregar opciones a un <select>.
function addOptions(domElement, array) {
    var selector = document.getElementsByName(domElement)[0];
    //Recorremos el array.
    for (categoria in array) {
        var opcion = document.createElement("option");
        opcion.text = array[categoria];
        opcion.value = array[categoria];
        selector.add(opcion);
    }
}

//Función para cargar las subcategorias al campo "select" dependiendo de la categoria elegida.
function cargar_subcategorias() {
    //Objeto de categorias con las subcategorias correspondientes.
    var listaSubcategorias = {
        Polos: ["Polo Cuello Redondo", "Polo Cuello Camisero", "Polo Cuello Redondo ML", "Polo Cuello Camisero ML"],
        Pantalones: ["Buzo", "Jogger"],
        Poleras: ["Polera con capucha", "Polera sin capucha"],
        Conjuntos: ["Conjunto Sport", "Conjunto Polo Short"],
        Otros: ["Casaca", "Bividi", "Short"]
    }

    //Declaramos un array donde guardamos todos los elementos de tipo id=provincias e id=pueblos.
    var categorias = document.getElementById('Categoria');
    var subcategorias = document.getElementById('Subcategoria');
    //Tomamos como categoriaSeleccionada, el valor del id categoria (var categoria).
    var categoriaSeleccionada = categorias.value;
    //Se limpian los pueblos.
    subcategorias.innerHTML = '<option value="">Seleccione subcategoría...</option>'

    //Si existe categoriaSeleccionada...
    if (categoriaSeleccionada !== "") {
        //Se seleccionan las subcategorias y se ordenan.
        categoriaSeleccionada = listaSubcategorias[categoriaSeleccionada];
        categoriaSeleccionada.sort();

        //Insertamos las subcategorias mediante un FOR.
        categoriaSeleccionada.forEach(function(subcategoria) {
            let opcion = document.createElement('option');
            opcion.value = subcategoria;
            opcion.text = subcategoria;
            subcategorias.add(opcion);
        });
    }
}

cargar_categorias();