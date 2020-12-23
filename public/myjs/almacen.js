function e2_categoria(op,id) {
  swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" la categoría ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               $.ajax({ 
            type:'POST',
            url: "Categoria/activar_eliminar",
            data:{id:id,op:op},
            success: function(e){
                data=eval(e);
                swal("La categoria se "+data+" con excito!", {
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
/*------------------------------------------------MARCA--------------------------------------------------------------*/
function e2_marca(op,id) {
  swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" la marca ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               $.ajax({ 
            type:'POST',
            url: "Marca/activar_eliminar",
            data:{id:id,op:op},
            success: function(e){
                data=eval(e);
                swal("La marca se "+data+"on con excito!", {
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
/*------------------------------------------------PRODUCTO--------------------------------------------------------------*/
function e2_producto(op,id) {
  swal({
            title: "Confirmar",
            text: "¿ Desea "+op+" el producto ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
               $.ajax({ 
            type:'POST',
            url: "Producto/activar_eliminar",
            data:{id:id,op:op},
            success: function(e){
                data=eval(e);
                swal("El producto se "+data+" con excito!", {
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