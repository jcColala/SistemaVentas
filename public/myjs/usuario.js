function e2_usuario(op,id) {
	swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" el slider ?",
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