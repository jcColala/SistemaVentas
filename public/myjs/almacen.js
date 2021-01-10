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

var codbrr="";

function ver_mas(codb,desc,cat,stock,pv,estado){
    jQuery.noConflict();
    if (estado == '') { estado='Activo';}else{ estado='Inactivo';}
    codbrr=codb;
    $('#ModalProducto').appendTo("body").modal('show');
    $("#sec_codbrr").html("<img src='./public/codigobrr/barcode.php?text="+codb+"&size=50&orientation=horizontal&codetype=Code128&print=true''>");
     $("#ul_det_product").html("<li class='list-group-item'>"+codb+"</li><li class='list-group-item'>"+desc+"</li><li class='list-group-item'>"+cat+"</li><li class='list-group-item'>S/ "+pv+"</li><li class='list-group-item'>"+stock+"</li><li class='list-group-item'>"+estado+"</li>");
}

function imprimir_cobarr(event){
    event.preventDefault();
    jQuery.noConflict();
    var cant = document.getElementById('cant').value;
    if (cant<=0) { toastr["error"]("Cantidad invalida","ERROR"); return false; }
    window.open('Producto/imprimir?c='+codbrr+'&ct='+cant , '_blank');
} 