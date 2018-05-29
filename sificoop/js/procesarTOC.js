function mostrar_info(){
	var value = document.getElementById("Selectsocio").value;
	var url = "../conexiones/conexionesTransferenciasOC/mostrar_infosocio.php";

	$.ajax({
		type:"post",
		url:url,
		data:{socio:value},

		success:function(datos){
			$("#mostrardatos").html(datos);
		}
	}
		)
}