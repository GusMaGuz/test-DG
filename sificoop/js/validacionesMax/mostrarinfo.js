function muestra_info(){
		var value = document.getElementById("valorSelect").value;
		var url = "../../Socio/WSDL/procesar_infoServ.php";
		var url2 = "../../Socio/WSDL/mostrar_total.php";

		$.ajax({
			type:"post",
			url:url,
			data:{posicion:value},

			success:function(datos){
				$("#mostrardatos").html(datos);
			}
		}
			)

		$.ajax({
			type:"post",
			url:url2,
			data:{posicion:value},

			success:function(datos){
				$("#mostrarTotal").html(datos);
			}
		}
			)
}