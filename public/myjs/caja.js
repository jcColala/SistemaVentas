function mostrarp(){
		comprobante=$("#comprobante_config").val();
		serie=$("#serie_config").val();
		correlativo=$("#correlativo_config").val();
		igv=$("#IGV_config").val();
		info=comprobante.split("*");
		html="<tr>";
		html+="<td><input type='hidden' name='id_comprobante[]' value='"+info[0]+"' readonly>"+info[1]+"</td>";
		html+="<td><input type='text' name='serie[]' id='serie[]' onkeypress='return Letras_numeros(event);'  value='"+serie+"' ></td>";
		html+="<td><input type='text' name='correlativo[]' onkeypress='return Letras_numeros(event);' value='"+correlativo+"' ></td>";
		html+="<td><input type='text' name='igv[]' onkeypress='return Letras_numeros(event);' value='"+igv+"' ></td>";
		html+="<td><button type='button' class='btn btn-danger btn-remove-comprobante' ><span class='fas fa-trash-alt'></span></button></td>";
		html+="</tr>";
		
		$("#exampleReport tbody").append(html);
		$("#comprobante_config").val(" ");
		$("#serie_config").val(" ");
		$("#correlativo_config").val(" ");
		$("#IGV_config").val(" ");
		// $.ajax({
  //     			type: "POST",
  //     			data:'id='+option,
  //     			url: "http://localhost:8080/lp4p3/Venta/valida_producto/",
  //     			success:function(res){
  //     			if (res==1){
  //     					c=Number(document.getElementById("listadox").value);
  //     					data=document.getElementById("btn-agregar").value;
		// 					if (data !=" "){
		// 						info=data.split("*");
		// 						producto=info[8]+' '+info[2]+' '+info[3]+' Talla'+info[4]+' '+info[5];
		// 						html="<tr>";
		// 						html +="<td><input type='hidden' name='id_prod[]' value='"+info[0]+"'>"+info[0]+"</td>";
		// 						html +="<td>"+producto+"</td>";
		// 						html +="<td><input type='hidden' name='precio[]' id='precio' value='"+info[7]+"'>"+info[7]+"</td>";
		// 						html +="<td><input type='hidden' name='stock[]' id='stock' value='"+info[6]+"'>"+info[6]+"</td>";
		// 						html +="<td><input type='text' id='cantida_pro' name='cantida_pro[]' value='1'onkeypress='return Numeros(event);' onpaste='return false' class='cantidades'></td>";
		// 						html +="<td><input type='hidden' name='sub_total[]' value='"+info[7]+"'><p>"+info[7]+"</p></td>";
		// 						html +="<td><button type='button' class='btn btn-danger btn-remove-producto'  onclick='cambiar_id()'><span class='fa fa-remove'></span></button></td>";
		// 						html +="</tr>";
		// 						$("#tbventas tbody").append(html);
		// 						c=c+1;
		// 						listadox=document.getElementById("listadox").value=c;
		// 						document.getElementById("codigoprod").value="";
		// 						document.getElementById("btn-agregar").value="";
		// 						sumar();
		// 						$("#btn-agregar").val(null);
		// 						$("#categoria").val(null);
		// 						$("#marca").val(null);
		// 						$("#color").val(null);
		// 						$("#talla").val(null);
		// 						$("#descripcion").val(null);
		// 						}
		// 						else{
		// 							alert("seleccione alog");
		// 							}

		// 					 $(document).on("click",".btn-remove-producto",function(){
		// 					 $(this).closest("tr").remove();
		// 					sumar();});

		// 					$(document).on("keyup","#tbventas input.cantidades",function(){
		// 					cantidad=$(this).val();
		// 					precio=$(this).closest("tr").find("td:eq(2)").text();
		// 					importe=Number(cantidad) * Number(precio);
		// 					$(this).closest("tr").find("td:eq(5)").children("p").text(importe);
		// 					$(this).closest("tr").find("td:eq(5)").children("input").val(importe);
		// 					sumar();
		// 				  });

  //     			}else if (res==2){
  //     				$.notify("El Producto no tiene precios");
  //     			 	return false;
  //     			}
  //     			 else{
  //     			 	$.notify("EL Producto no existe");
  //     			 	return false;
  //     			 }}
  //     		})

}
function procesar_caja_cofig(){
	caja=$("#caja_config").val();
	var nFilas = $("#exampleReport tr").length;
	tam=nFilas-1;
	for (var i=0 ; i<tam; i++){
		serie=document.getElementsByName("serie[]")[i].value;
		correlativo=document.getElementsByName("correlativo[]")[i].value;
		igv=document.getElementsByName("igv[]")[i].value;
		if(serie ==false ){
			alertify.error('serie requerido');
			return false;	
		}
		if(correlativo ==false ){
			alertify.error('correlativo requerido');
			return false;	
		}
		if(igv ==false ){
			alertify.error('igv requerido');
			return false;	
		}
	}
	if(caja==""){
		alertify.error('Campo requerido');
		return false;
	}
	if(nFilas<2){
		alertify.error('Campo requerido');
		return false;
	}
               $.ajax({ 
			      type:'POST',
			      url: "ConfiguracionCaja/updateConfig",
			      data:$("#form_configcaja").serialize(),
			      success: function(e){
			      		data=eval(e);
			      		swal("El registro se modificó con éxito ", {
                                  icon: "success",
                                  buttons: false,
                                  timer: 1500,
                                });
                        window.setInterval('reFresh()',1000);
                    }
			      });
	}

	function cerrar_caja_cofig(){
		window.setInterval('reFresh()');
	}
 