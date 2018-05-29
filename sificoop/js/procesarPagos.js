function actualizar_info(){
		var value = document.getElementById("valorSelect").value;
		var url = "../conexiones/conexionesPagos/procesar_infoPagos.php";
		var url2 = "../conexiones/conexionesPagos/procesar_Total.php";

		$.ajax({
			type:"post",
			url:url,
			data:{credito:value},

			success:function(datos){
				$("#mostrardatos").html(datos);
			}
		}
			)

		$.ajax({
			type:"post",
			url:url2,
			data:{credito:value},

			success:function(datos){
				$("#mostrarTotal").html(datos);
			}
		}
			)
}

function actualizar_total(){
		var value = document.getElementById("valorSelect").value;
		var cantidad = document.getElementById("vspre").value; 
		//alert("Esta es la cantidad "+cantidad);
		if(!/^(\d)+((\.)(\d){1,2})?$/.test(cantidad)){
			alert("Escriba una cantidad valida. Ej= 400.50 \nSi la cantidad no tiene centavos solo escriba Ej= 400.00\nEvita espacios.");
		 	document.getElementById('vspre').value = '';
		 	document.vspre.focus();
		}
		else{
			var url2 = "../conexiones/conexionesPagos/procesar_nuevoTotal.php";

			$.ajax({
				type:"post",
				url:url2,
				data:{credito:value,cantidad:cantidad},

				success:function(datos){
					$("#mostrarTotal").html(datos);
				}
			}
			)
		}
}