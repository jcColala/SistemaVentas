$(document).on("keyup","#monto_pago",function(){
	$monto_caja=Number($("#monto_caja").val());
	montopago=$(this).val();
	totalpago=$("#total_pago").val();
	vuelto=Number(montopago)-Number(totalpago);
	$("#vuelto_pago").val(vuelto.toFixed(2))
	if($monto_caja<vuelto){
		alertify.error('monto de caja insuficiente');	
	}
});

function buscarlocal(){
	dni=$("#doc_venta").val();
	dni=dni.trim();
	if(dni==""){
		alertify.error('documento requerido');
			return false;	
	}else{
		$.ajax({ 
  			   type:'POST',
  			   url: "ClientesController/getclientedni",
  			   data:{dni:dni},
  			    success: function(data){
  			    	$("#"+N+" "+".modal-body").html(data);
  			    }
  				});
	}

}

function agregarproductoventa(){
	window.location.href = BASE_URL+"/Compra/agregarViews";
	let estadoAgregar="V";
	localStorage.setItem("estadoAgregar",estadoAgregar);
}
function guardarclienteventa(){
	tipocliente=$("#tipo_cliente").val();
	dni_cliente=$("#dni_cliente").val();
	nombre_cliente=$("#nombre_cliente").val();
	apellidos_cliente=$("#apellidos_cliente").val();
	direccion_cliente=$('#direccion_cliente').val();
	if(tipocliente==""){
		$( "#tipo_cliente" ).focus();
		id="#tipo_cliente";
		cambiacolor(id);
		return false;
	}
	else if(dni_cliente==""){
		$( "#dni_cliente" ).focus();
		id="#dni_cliente";
		cambiacolor(id);
		return false;
	}
	else if(nombre_cliente==""){
		$( "#nombre_cliente" ).focus();
		id="#nombre_cliente";
		cambiacolor(id);
		return false;
	};
	dni=$("#dni_cliente").val();
	dni=dni.trim();
	tam=dni.length;
	if(dni==""){
		alertify.error('RUC requerido');
			return false;	
	}
	let clientemodel ={
    documento:dni_cliente,
    nombre:nombre_cliente,
    apellido:apellidos_cliente,
    direccion:direccion_cliente,
  }
  localStorage.setItem("listacliente", JSON.stringify(clientemodel));
	 $.ajax({ 
  			   type:'POST',
  			   url: BASE_URL+"/ClientesController/agregar2",
  			   data:$("#formmodelcliente").serialize(),
  			    success: function(data){
  			    	let listacliente=JSON.parse(localStorage.getItem("listacliente"));
  			    	 console.log(listacliente);
  			    	 doc=listacliente.documento;
  			    	 nombre=listacliente.nombre;
  			    	 apellidov=listacliente.apellido;
  			    	 direccionv=listacliente.direccion,
  			    	 $("#doc_venta").val(doc);
  			    	 $("#nombre_venta").val(nombre);
  			    	 $('#direccion_venta').val(direccionv);
  			    	 $("#modalclientepedido").modal('hide');//ocultamos el modal
  					$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  						$('.modal-backdrop').remove();//eliminamos el backdrop del modal
  			    	 
  			    	  $("#formmodelcliente")[0].reset();
  			    }
  				});
	
	
	}

function cambiacolor(id){
	$(id).css("border", "2px solid red");
}
$( "#comprobante_venta" ).change(function() {
 datos_comprobante=$("#comprobante_venta").val();
 if(datos_comprobante != ""){
 	datos_comprobante=datos_comprobante.split("*");
 	id_comprobante=datos_comprobante[0];
 	serie=datos_comprobante[2];
 	comprobante=datos_comprobante[1];
 	comprobante=comprobante.toUpperCase();
 	correlativo=parseInt(datos_comprobante[3]);
 	valor_igv=datos_comprobante[4];
 	iddetalle_comprobante=datos_comprobante[5];
 	$("#v_igv").val(valor_igv);
 	$("#id_comprobante").val(id_comprobante);
	$("#serie_venta").val(serie);
	$("#iddetalle_comprobante").val(iddetalle_comprobante);
	$("#correlativo_venta").val(generarnumero(Number(correlativo)));
	
 }else{
 	$("#idtipo_comprobante").val(null);
	$("#serie_venta").val(null);
	$("#correlativo_venta").val(null);
 }
 calcular_total();
});


  $("#producto_venta").autocomplete({
	source: function(request, response){
		$.ajax({
			url: "VentasController/getProducto",
			type:"POST",
			dataType: "json",
			data:{ valor: request.term},
			success:function(data){
				response(data);

			}

		});
	},
	minLength:2,
	select:function(event, ui){
		data= ui.item.idProducto;
		producto=ui.item.label;
		preciocompra=ui.item.PrecioCompra;
		precioVenta=ui.item.precioVenta;
		nombre=ui.item.Descripcion;
		stock=ui.item.Stock;
		var nFilas = $("#tbventas tr").length;
		if(stock<=0){
			alertify.error('No hay stock del producto');
			return false;	
		}else{
		bandera="B";
		num=nFilas-1;
		if(nFilas<2){
		 agregarProductoTabla(data,producto,preciocompra,precioVenta,nombre,stock);
		 $("#producto_venta").val(""); 
    	
		}else{
		for (i=0; i<num; i++){	
				id_prod=Number(document.getElementsByName("id_prod[]")[i].value);
				if(data==id_prod){
				cantidadActual=Number(document.getElementsByName("cantida_pro[]")[i].value);
				precioca=Number(document.getElementsByName("precioVenta[]")[i].value);
				cantidadsum=cantidadActual+1;
				document.getElementsByName("cantida_pro[]")[i].value=cantidadsum;
				subtotalc=cantidadsum*precioca;
				document.getElementsByName("sub_total[]")[i].value=subtotalc;
				// add=	$("input[name='subtotal[]']").closest("tr").find("td:eq(5)").children("p").text();
				// console.log(add);

				jQuery("input[name='cantida_pro[]'] ").each(function() {
    				cantidad=$(this).val();
					precio=$(this).closest("tr").find("td:eq(2)").children("input").val();
					importe=Number(cantidad) * Number(precio);
					$(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
					$(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
					calcular_total();

    			});
				bandera="C";
				}	

			}

		if(bandera=="B"){
			agregarProductoTabla(data,producto,preciocompra,precioVenta,nombre,stock);
			$("#producto_venta").val(""); 
			}

		}
		 $("#producto_venta").val(""); 
		return false;
		
    }
	},
});
function agregarProductoTabla(data,producto,preciocompra,precioVenta,nombre,stock){
	html="<tr>";
		html +="<td><input type='hidden' name='producto_nombre[]' value='"+producto+"'><input type='hidden' name='id_prod[]' value='"+data+"'>"+producto+"</td>";
		html +="<td>"+preciocompra+"</td>";
		html +="<td><input type='text' id='precioVenta[]' name='precioVenta[]' value='"+precioVenta +"'onkeypress='return Numeros_otro(event);' onpaste='return false' class='precio_venta'></td>";
		html +="<td><input type='hidden' name='stock[]' id='stock' value='"+stock+"'>"+stock+"</td>";
		html +="<td><input type='text' id='cantida_pro' name='cantida_pro[]' value='1' onkeypress='return Numeros(event);' onpaste='return false' class='cantidades'></td>";
		html +="<td><input type='hidden' id='sub_total' name='sub_total[]' value='"+precioVenta+"'><p>"+precioVenta+"</p></td>";
		html +="<td><button type='button' class='btn btn-danger btn-remove-producto'  ><span class='fas fa-trash-alt'></span></button></td>";
		html +="</tr>";
		$("#tbventas tbody").append(html);
		calcular_total();
} 
$(document).on("click",".btn-remove-producto",function(){
	$(this).closest("tr").remove();
	calcular_total();
	});

$(document).on("keyup","#tbventas input.cantidades",function(){
							cantidad=$(this).val();
							precio=$(this).closest("tr").find("td:eq(2)").children("input").val();
							importe=Number(cantidad) * Number(precio);
							$(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
							$(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
							calcular_total();
						  });
$(document).on("keyup","#tbventas input.precio_venta",function(){
							precio=$(this).val();
							

							cantidad=$(this).closest("tr").find("td:eq(4)").children("input").val();
							
							importe=Number(cantidad) * Number(precio);
							$(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
							$(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
							calcular_total();
 });

$(document).on("keyup","#descuento_venta",function(){
	calcular_total();
});

function calcular_total(){
	subtotal=0;
	$("#tbventas tbody tr").each(function(){
		subtotal=subtotal + Number($(this).find("td:eq(5)").children("p").text());
		subtotal;
	});
	$("input[name=subtotal]").val(subtotal.toFixed(2));
	porcentaje=$("#v_igv").val();
	igv=subtotal*(porcentaje/100);
	$("#igv_venta").val(igv.toFixed(2));
	descuento=$("#descuento_venta").val();
	total=subtotal+igv-descuento;
	$("#total_venta").val(total.toFixed(2));
	// $("#totalx").val(subtotal);
	// $("#total_vuelto").val(subtotal);
	
}


function generarnumero(numero){
	if (numero>= 99999 && numero < 999999){
		return Number(numero)+1;
	}
	if (numero>=9999 && numero<99999){
		return "0" + (Number(numero)+1);
	}
	if (numero>=999 && numero<9999){
		return "00"+ (Number(numero)+1);
	}
	if (numero>=99 && numero<999){
		return "000"+ (Number(numero)+1);
	}
	if (numero>=9 && numero<99){
		return "0000"+ (Number(numero)+1);
	}
	if (numero<9){
		return "00000" + (Number(numero)+1);
	}


}

// $( "#btn-busquedad" ).click(function() {
//   ndoc=$("#doc_venta").val();
//   tipo_busquedad=$("#btn-busquedad").text();
//   if(ndoc==0 && tipo_busquedad=="RENIEC"){
//   	$("#nombre_venta").val("CLIENTE VARIOS")
//   }else if(ndoc==0 && tipo_busquedad=="SUNAT"){
//   	alertify.error('COMPROBANTE ERRONEO');
//   }else if(tipo_busquedad=="SUNAT"){
//   	valsunatVenta();
//   }else if (tipo_busquedad="RENIEC"){
//   	valdniVenta();
//   }

// });

$( "#btn-busquedad" ).click(function() {
  ndoc=$("#doc_venta").val();
  tipo_busquedad=$("#btn-busquedad").text();
  if(ndoc==""){
  	alertify.error('DNI/RUC es requerido');
  	return false;
  }else if(ndoc==0){
  	$("#nombre_venta").val("CLIENTE VARIOS")
  }else{
  	$.ajax({ 
  			   type:'POST',
  			   url: "ClientesController/getclientedni",
  			   data:{dni:ndoc},
  			    success: function(data){
  			    	if(data=="A"){
  			    		alertify.error('El usuario no existe en el sistema, agregar');
  			    	}else{
  			    		var response = JSON.parse(data);
      					$("#nombre_venta").val(response.nombre);
      					$("#direccion_venta").val(response.direccion);
  			    	}
  			    }
  				});
  }

});

function valdniVenta(){
	dni=$("#doc_venta").val();
	dni=dni.trim();
	tam=dni.length;
	if(dni==""){
		alertify.error('DNI requerido');
			return false;	
	}else if(tam != 8 ){
		alertify.error('Tamaño DNI requerido');
			return false;	
	}else{
		getReniecVenta();
	}	
}
function valsunatVenta(){
	dni=$("#doc_venta").val();
	dni=dni.trim();
	tam=dni.length;
	if(dni==""){
		alertify.error('RUC requerido');
			return false;	
	}else if(tam != 11){
		alertify.error('Tamaño RUC requerido');
			return false;	
	}else{
		getSunatVenta();
	}	
}
async function getSunatVenta() 
{
 $("#contenedor").slideDown(0);	
  dni=$("#doc_venta").val();
  dni=dni.trim();	
  const url="https://dniruc.apisperu.com/api/v1/ruc/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleXNhbmdhbWE3QGdtYWlsLmNvbSJ9.hfobQC8FM5IyKKSaa7usUXV0aY1Y8YthAhdN8LoMlMM";
  fetch(url)
  .then(response=>response.json())
  .then(data =>{
  	
  	$("#nombre_venta").val(data.razonSocial);
  	$("#n_venta").val(data.razonSocial);
  	$("#direccion_venta").val(data.direccion);
  })
  .catch(() => {
   alertify.error('No se encontró razonSocial');
    $("#contenedor").slideUp();
})

}

async function getReniecVenta() 
{
 $("#contenedor").slideDown(0);	
  dni=$("#doc_venta").val();
  dni=dni.trim();	
  const url="https://dniruc.apisperu.com/api/v1/dni/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleXNhbmdhbWE3QGdtYWlsLmNvbSJ9.hfobQC8FM5IyKKSaa7usUXV0aY1Y8YthAhdN8LoMlMM";
  fetch(url)
  .then(response=>response.json())
  .then(data =>{
  	$("#nombre_venta").val(data.nombres+" "+data.apellidoPaterno+" "+data.apellidoMaterno);
  	$("#n_venta").val(data.nombres);
  	$("#a_venta").val(data.apellidoPaterno+" "+data.apellidoMaterno);
  	 $("#contenedor").slideUp();
  })
  .catch(() => {
   alertify.error('No se encontró persona');
    $("#contenedor").slideUp();
})

}



function verVentaCompleta2(id,N){
	 $.ajax({ 
  			   type:'POST',
  			   url: "getventaU",
  			   data:{id:id},
  			    success: function(data){
  			    	$("#"+N+" "+".modal-body").html(data);

  			    }
  				});
}

function eliminar_venta(id){
	swal({
              title: "Confirmar",
              text: "¿ Desea eliminar la venta ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
			      type:'POST',
			      url: BASE_URL+"/VentasController/eliminarventa",
			     data:{id:id},
			      success: function(e){
			      	window.setInterval('reFresh()',1000);
                    }
			      });

              }
      });
}



