function cancelar(){
	location.href='../index.php';
}

/*function acceso(){
	location.href='../accesoAdm.php';
}*/

function limpiar(cuadro){
    if(window.event){
    keynum = cuadro.keyCode;
    }
    else{
    keynum = cuadro.which;
    } 
    if((keynum > 47 && keynum < 58 || keynum==8)){
        return true;
    }
    else{
     return false;
    }
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toString();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = [8, 6]; 

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}