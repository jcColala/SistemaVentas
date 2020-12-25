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

const crear_array = (id,texto,cant,preciov)=>{
  let array ={
    id:id,
    datos:texto,
    cant:cant,
    preciov:preciov
  }
  lista.push(array);
}
const guardar_store = ()=>{

   localStorage.setItem("lista", JSON.stringify(lista));
}

function anadir_producto(){
  var id = $('#id_producto').val();
  var id_t = document.getElementById("id_producto");
  var texto = id_t.options[id_t.selectedIndex].text;
  var preciov = "0.0";

  crear_array(id,texto,1,preciov);
  guardar_store();

  lista=JSON.parse(localStorage.getItem("lista"));
  crear_lista()
}

function crear_lista(){
  lista.forEach(element => {
      HTML=HTML+`<tr><td>e</td><td>${element.datos}</td><td class='centrar'><input type="text" value="${element.cant}"></td><td class='centrar'><input type="text" value="${element.preciov}" step="any"></td><td class='centrar'>e</td><td class='centrar'><button onclick="elim_dcompra(${element.id});" class="icon-delete_forever elim_dcompra" title="Eliminar"></button></td></tr>`;
      $("#tbody_dt_pro").html(HTML);
  });
  var HTML="";
}  


function elim_dcompra(id){
  let indexarray="";
  lista.forEach((elemento,index) => {
    if (elemento.id == id) {
      indexarray= index;
    }
  });
  lista.splice(indexarray,1);
  guardar_store();
  swal("Producto eliminado con excito!", {
        icon: "success",
        buttons: false,
        timer: 1000,
  });
  crear_lista();
}