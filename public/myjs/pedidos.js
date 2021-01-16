function procesarpedido(){

	var nFilas = $("#tbventas tr").length;
	total=isNaN($("#total_venta").val());
	datos_comprobante=$("#comprobante_venta").val();
	datos_comprobante=datos_comprobante.split("*");
	comprobante=datos_comprobante[1];
	doc=$("#doc_venta").val();
	tamdoc=doc.length;

	
	if(comprobante=="FACTURA" || comprobante=="FACTURA ELECTRÓNICA" || comprobante=="FACTURA DE VENTA ELECTRÓNICA"){
		
		if(Number(tamdoc)<11){
			
			alertify.error('Error en el tipo de comprobante');
			return false;
		}
	}
	else if($("#comprobante_venta").val()==""){
		alertify.error('Comprobante requerido');
		return false;
	}else if($("#doc_venta").val()==""){
		alertify.error('Documento requerido');
		return false;
	}else if($("#nombre_venta").val()==""){
		alertify.error('Nombre/Raz.soc requerido');
		return false;

	}else if(nFilas<2){
		alertify.error('Productos requerido');
		return false;
	}else if(total==true){
		alertify.error('Error precios');
		return false;
	}
	else{
		num=nFilas-1;
		for (i=0; i<num; i++){
			
		stock=Number(document.getElementsByName("stock[]")[i].value);
 		cantida_pro=Number(document.getElementsByName("cantida_pro[]")[i].value);
 		if (cantida_pro=="" || cantida_pro<1 ){
 				alertify.error("Cantidad de producto Incorrecta");
    			return false;}
    		else if (cantida_pro>stock){
    			alertify.error("Cantidad Supera al Stock");
    			return false;
    		}
		}
		swal({
              title: "Confirmar",
              text: "¿ Desea procesar el pedido ?",
              icon: "info",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
              	$("#contenedor").slideDown(0);	
                 $.ajax({ 
			      type:'POST',
			      url: BASE_URL+"/ListadoPedidosController/procesarPedido",
			      data:$("#form_venta").serialize(),
			      success: function(e){
			      	window.setInterval('reFresh()',1000);
                    }
			      });

              }
      });
	}
	 
}function eliminar_pedido(id){
	swal({
              title: "Confirmar",
              text: "¿ Desea eliminar el pedido ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
			      type:'POST',
			      url: BASE_URL+"/ListadoPedidosController/eliminarpedido",
			     data:{id:id},
			      success: function(e){
			      	window.setInterval('reFresh()',1000);
                    }
			      });

              }
      });
}

function verPedidoCompleto(id,N){
	 $.ajax({ 
  			   type:'POST',
  			   url: "ListadoPedidosController/getPedidoU",
  			   data:{id:id},
  			    success: function(data){
  			    	$("#"+N+" "+".modal-body").html(data);
  			    	a=$("#totalventamodal").val();
  			    	$("#total_pago").val(a);
  			    }
  				});
}
function listProcesarVenta(){
	monto_pago=$("#monto_pago").val();
	vuelto_pago=$('#vuelto_pago').val();
	caja=Number($("#monto_caja").val());
	if(monto_pago=="" ){
		alertify.error('monto de pago incorrecto');
		return false;
	}else if(vuelto_pago<0){
		alertify.error('vuelto incorrecto');
		return false;
	}else if(caja<1){
		alertify.error('Monto de caja incorrecto, Abrir caja');
		return false;
	}else{

	id=$("#idventaProcesar").val();
	window.open(BASE_URL+'/VentasController/fpdf?id='+id, '_blank');
	window.setInterval('reFresh()',1000);}
}