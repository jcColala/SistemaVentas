

function valdni(){
	dni=$("#dni_cliente").val();
	tam=dni.length;
	if(dni==""){
		alertify.error('DNI requerido');
			return false;	
	}else if(tam<8){
		alertify.error('Tamaño requerido');
			return false;	
	}else{
		getReniec();
	}	
}
function valsunat(){
	dni=$("#dni_cliente").val();
	tam=dni.length;
	if(dni==""){
		alertify.error('RUC requerido');
			return false;	
	}else if(tam<11){
		alertify.error('Tamaño requerido');
			return false;	
	}else{
		getSunat();
	}	
}
async function getSunat() 
{
  dni=$("#dni_cliente").val();	
  const url="https://dniruc.apisperu.com/api/v1/ruc/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleXNhbmdhbWE3QGdtYWlsLmNvbSJ9.hfobQC8FM5IyKKSaa7usUXV0aY1Y8YthAhdN8LoMlMM";
  fetch(url)
  .then(response=>response.json())
  .then(data =>{
  	
  	$("#nombre_cliente").val(data.razonSocial);
  	$("#direccion_cliente").val(data.direccion);
  })
  .catch(err=>console.log(err))

}

async function getReniec() 
{
  dni=$("#dni_cliente").val();	
  const url="https://dniruc.apisperu.com/api/v1/dni/"+dni+"?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJleXNhbmdhbWE3QGdtYWlsLmNvbSJ9.hfobQC8FM5IyKKSaa7usUXV0aY1Y8YthAhdN8LoMlMM";
  fetch(url)
  .then(response=>response.json())
  .then(data =>{
  	console.log(data)
  	$("#nombre_cliente").val(data.nombres);
  	$("#apellidos_cliente").val(data.apellidoPaterno+" "+data.apellidoMaterno);
  })
  .catch(err=>console.log(err))

}

function eliminar_cliente(id,op){
	swal({
              title: "Confirmar",
              text: "¿ Desea eliminar el cliente ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
  			      type:'POST',
  			      url: "ClientesController/activar_eliminar",
  			      data:{id:id,op:op},
  			      success: function(e){
  			      		data=eval(e);
  			      		swal("Usuario "+data+" con excito!", {
                                    icon: "success",
                                    buttons: false,
                                    timer: 1500,
                                  });
                          window.setInterval('reFresh()',1000);
  			      }
  				});

              }
      });
}
function activar_cliente(id,op){
	 swal({
            title: "Confirmar",
            text: "¿ Desea  activar el cliente ?",
            icon: "info",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               $.ajax({ 
            type:'POST',
            url: "ClientesController/activar_eliminar",
            data:{id:id,op:op},
            success: function(e){
                data=eval(e);
                swal("Tipo Usuario "+data+" con excito!", {
                                  icon: "success",
                                  buttons: false,
                                  timer: 1500,
                                });
                        window.setInterval('reFresh()',1000);
            }
        });

            }
    });
}