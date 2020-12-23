function e2_proveedor(op,id) {
  swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" el Proveedor ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {
                 $.ajax({ 
  			      type:'POST',
  			      url: "Proveedor/activar_eliminar",
  			      data:{id:id,op:op},
  			      success: function(e){
  			      		data=eval(e);
  			      		swal("Proveedor "+data+" con excito!", {
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
