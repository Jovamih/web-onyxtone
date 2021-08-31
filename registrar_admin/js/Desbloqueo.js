function TodoCorrecto(){
    var aux = false;
    var select = document.getElementById("Categoria");
    var valor_cat = select.value;
    var select2 = document.getElementById("Subcategoria");
    var valor_subcat = select2.value;
    
    if(valor_cat != "" && valor_subcat != ""){
        aux = true;
    }
    return aux;
}

function Desbloquear() {
    if(TodoCorrecto()){
        document.getElementById("Cantidad").removeAttribute("disabled");
    }                        
}