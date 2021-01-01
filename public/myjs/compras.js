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
/*----------------------------------------------------COMPRAS ------------------------------------------------------*/

var totalC="0";
var subtotalC=0;

const crear_array = (id,texto,cant,precioc)=>{
  let array ={
    id:id,
    datos:texto,
    cant:cant,
    precioc:precioc
  }
  lista.push(array);
}
const guardar_store = ()=>{
   localStorage.setItem("lista", JSON.stringify(lista));
}

const modificar_subtotal= (indexarray)=>{
   $("#subtotal"+lista[indexarray].id).html("S/. "+(parseInt(lista[indexarray].cant)*parseFloat(lista[indexarray].precioc)).toFixed(2));
}
const obtener_total= ()=>{
  var total=0;
  lista.forEach(element => {
    total=total+(parseInt(element.cant)*parseFloat(element.precioc));
    /*total=Math.round(total);*/
    if ( parseFloat(element.precioc)<=0 ){subtotalC=1;}else{subtotalC=0;}
  });
  total=total.toFixed(2);
  document.getElementById('total_compra').value="S/ "+total;
  totalC=total;
}

function agregarProd(){
  var id = $('#id_producto').val();
  if (id=="") {
    return false;
  }
  let indexarray="";
  var comprov=0;
  lista.forEach((elemento,index) => {if (elemento.id == id) {indexarray= index; comprov=1;}});
  if (comprov==1) {
     lista[indexarray].cant=parseInt(lista[indexarray].cant)+1;
     document.getElementById('compras_cant'+id).value=lista[indexarray].cant;
     modificar_subtotal(indexarray);
     obtener_total();
     guardar_store();
     return true;
  }
  var id_t = document.getElementById("id_producto");
  var texto = id_t.options[id_t.selectedIndex].text;
  var precioc = "0.00";

  crear_array(id,texto,1,precioc);
  guardar_store();

  lista=JSON.parse(localStorage.getItem("lista"));
  crear_lista();
}

function crear_lista(){
  var HTML="";
  var loc_st=localStorage.getItem("lista");
  if (loc_st.length==2) { obtener_total();lista=[]; $("#tbody_dt_pro").html("");}
  else{
    var n=1;
    lista.forEach(element => {
      HTML=HTML+`<tr><td class='centrar'>${n}</td><td class='td_det_compra'><input class="det_c_input" type="number" id="compras_cant${element.id}" value="${element.cant}" onkeyup="edd_cantidad(${element.id});"></td><td>${element.datos}</td><td class='td_det_compra'><input type="number" class="det_c_input" id="compras_precio${element.id}" onkeyup="edd_precioC(${element.id});" value="${element.precioc}" step="any"></td><td class='centrar' id="subtotal${element.id}" >S/ ${(parseInt(element.cant)*parseFloat(element.precioc)).toFixed(2)}</td><td class='centrar'><span onclick="elim_dcompra(${element.id});" class="icon-delete_forever elim_dcompra" title="Eliminar"></span></td></tr>`;
      $("#tbody_dt_pro").html(HTML);
      n=n+1;
    });
    obtener_total();
    HTML="";
  }
}  


function elim_dcompra(id){
  swal({
              title: "Confirmar",
              text: "¿ Desea eliminar el Producto ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                let indexarray="";
                lista.forEach((elemento,index) => {
                  if (elemento.id == id) {indexarray= index;}
                });

                lista.splice(indexarray,1);
                swal("Producto eliminado con excito!", {
                      icon: "success",
                      buttons: false,
                      timer: 1500,
                });
                guardar_store();
                crear_lista(); 
            }
      });
}

function edd_cantidad(id){
  var cantidad = document.getElementById('compras_cant'+id).value;
  if (cantidad<=0 | cantidad=="" | cantidad==" ") { return false}
  let indexarray= lista.findIndex((elemento)=>elemento.id == id);
  lista[indexarray].cant=cantidad;
  modificar_subtotal(indexarray);
  obtener_total();
  guardar_store();

}
function edd_precioC(id){
  var precio = document.getElementById('compras_precio'+id).value;
  if (precio<=0 | precio=="" | precio==" ") { return false}
  let indexarray= lista.findIndex((elemento)=>elemento.id == id);
  lista[indexarray].precioc=precio;
  modificar_subtotal(indexarray);
  obtener_total();
  guardar_store();

}

//*--------------------------------CONSTANTES----------------------------------*//

const formularioUI= document.querySelector('#formulario_d_compras');
//*--------------------------------CONSTANTES----------------------------------*//


function guardr_det_compra(event){
  event.preventDefault();

  var numero= document.getElementById("numero").value;
  var serie= document.getElementById("serie").value;
  var compro= document.getElementById("idcompro").value;
  var idprovedor= document.getElementById("idprovedor").value;

  if (numero=="" | serie=="" | compro=="" | compro==" ") {
    seleccionar('div_1_modal','span_selec_1',2);
    $("#m_error").html("Tipo Comprobante, Número Comprobante y Número Serie son campos obligatorios");
    return false;
  }
  if ( idprovedor=="" | idprovedor==" ") {
    seleccionar('div_1_modal','span_selec_1',2);
    $("#m_error").html("Seleccione un Proveedor");
    return false;
  }
  var lista=[];
  var form_data = new FormData();

  lista=localStorage.getItem("lista");

  if (lista==null | lista=='[]') {
    seleccionar('div_2_modal','span_selec_2',2);
    $("#m_error_2").html("Ningún producto seleccionado es necesario ingresar por lo menos un producto");
    return false;
  }
  if (totalC=='0') {
    seleccionar('div_2_modal','span_selec_2',2);
    $("#m_error_2").html("El TOTAL no puede ser igual a cero");
    return false;
  }
  if (subtotalC==1) {
    seleccionar('div_2_modal','span_selec_2',2);
    $("#m_error_2").html("Producto(s) con Precio Unitario inválido");
    return false;
  }
  form_data.append('data_detalle',lista);
  form_data.append('numero',numero);
  form_data.append('serie',serie);
  form_data.append('compro',compro);
  form_data.append('idprovedor',idprovedor);
  form_data.append('totalC',totalC);

  $('#botones_modal').html('<img src="../public/gif/carga.gif" alt="loading" />');
  $("#m_error").html("");
  $("#m_error_2").html("");
  $.ajax({
    type:'POST', 
    data: form_data, 
    url:"agregar",
    crossOrigin : false,
    contentType : false,
    processData : false,
    success: function (response) {
        data=eval(response);
        lista=[];
        localStorage.setItem("lista", JSON.stringify(lista));
        swal("Compra "+data+" con excito!", {
                                    icon: "success",
                                    buttons: false,
                                    timer: 1500,
                                  });
        window.setInterval('reFresh()',1000)
    },
    error: function () {
      alert("error");
    }
  });

}