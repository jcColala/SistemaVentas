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
	if(comprobante=="FACTURA"){
		$("#btn-busquedad").text("SUNAT");
	}else if(comprobante=="BOLETA"){
		$("#btn-busquedad").text("RENIEC");
	}
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
		html="<tr>";
		html +="<td><input type='hidden' name='id_prod[]' value='"+data+"'>"+producto+"</td>";
		html +="<td>"+preciocompra+"</td>";
		html +="<td><input type='text' id='precioVenta[]' name='precioVenta[]' value='"+precioVenta +"'onkeypress='return Numeros_otro(event);' onpaste='return false' class='precio_venta'></td>";
		html +="<td><input type='hidden' name='stock[]' id='stock' value=''>"+stock+"</td>";
		html +="<td><input type='text' id='cantida_pro' name='cantida_pro[]' value='1' onkeypress='return numeros_precios(event);' onpaste='return false' class='cantidades'></td>";
		html +="<td><input type='hidden' name='sub_total[]' value='"+precioVenta+"'><p>"+precioVenta+"</p></td>";
		html +="<td><button type='button' class='btn btn-danger btn-remove-producto'  ><span class='fas fa-trash-alt'></span></button></td>";
		html +="</tr>";
		
		$("#tbventas tbody").append(html);
		calcular_total();
		 $("#producto_venta").val(""); 
    	return false;

	},
});
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

$( "#btn-busquedad" ).click(function() {
  ndoc=$("#doc_venta").val();
  tipo_busquedad=$("#btn-busquedad").text();
  if(ndoc==0 && tipo_busquedad=="RENIEC"){
  	$("#nombre_venta").val("CLIENTE VARIOS")
  }else if(ndoc==0 && tipo_busquedad=="SUNAT"){
  	alertify.error('COMPROBANTE ERRONEO');
  }else if(tipo_busquedad=="SUNAT"){
  	valsunatVenta();
  }else if (tipo_busquedad="RENIEC"){
  	valdniVenta();
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
		alertify.error('Tamaño requerido');
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
		alertify.error('Tamaño requerido');
			return false;	
	}else{
		getSunatVenta();
	}	
}
async function getSunatVenta() 
{
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
  .catch(err=>alertify.error('No se encontró RUC')
  	)

}

async function getReniecVenta() 
{
  dni=$("#doc_venta").val();
  dni=dni.trim();	
  const url="https://dniruc.apisperu.com/api/v1/dni/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleXNhbmdhbWE3QGdtYWlsLmNvbSJ9.hfobQC8FM5IyKKSaa7usUXV0aY1Y8YthAhdN8LoMlMM";
  fetch(url)
  .then(response=>response.json())
  .then(data =>{
  	$("#nombre_venta").val(data.nombres+" "+data.apellidoPaterno+" "+data.apellidoMaterno);
  	$("#n_venta").val(data.nombres);
  	$("#a_venta").val(data.apellidoPaterno+" "+data.apellidoMaterno);
  })
  .catch(err=>alertify.error('No se encontró DNI'))

}

function ProcesarVenta(){

	swal({
              title: "Confirmar",
              text: "¿ Desea procesar la venta ?",
              icon: "info",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
			      type:'POST',
			      url: "VentasController/procesarVenta",
			      data:$("#form_venta").serialize(),
			      success: function(e){
			      		
                    }
			      });

              }
      });
}