$( "#comprobante_venta" ).change(function() {
 datos_comprobante=$("#comprobante_venta").val();
 if(datos_comprobante != ""){
 	datos_comprobante=datos_comprobante.split("*");
 	id_comprobante=datos_comprobante[0];
 	serie=datos_comprobante[2];
 	correlativo=parseInt(datos_comprobante[3]);
 	correlativo=correlativo+1;
 	$("#idtipo_comprobante").val(id_comprobante);
	$("#serie_venta").val(serie);
	$("#correlativo_venta").val(correlativo);
 }
});