function e2_usuario(op,id) {
  if (id==1) {
    swal({
      icon: 'error',
      title: 'Error',
      text: 'Usuario sin permisos de eliminar',
    });
    return false;
  }
  else{
  	swal({
              title: "Confirmar",
              text: "¿ Desea "+op+" el Usuario ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
  			      type:'POST',
  			      url: "Usuario/activar_eliminar",
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
} 

/*---------------------------------------TIPO USUARIO--------------------------------------------------------*/
function e2_t_usuario(op,id) {
  swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" el Tipo Usuario ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               $.ajax({ 
            type:'POST',
            url: "TipoUsuario/activar_eliminar",
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