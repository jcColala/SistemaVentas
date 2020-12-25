<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" > 
        <h4>Registrar Compra</h4>
 
        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',2);" id="span_selec_1" class="span_selec_1">Registrar</span>
          <span  onclick="seleccionar('div_2_modal','span_selec_2',2);" id="span_selec_2" class="span_selec_2">Detalle Compra</span>
        </section>

        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/Compra/agregar" method="post" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <section id="div_1_modal" class="div_1_modal">
              <br>
              <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>N&uacute;mero Comprobante</label>
                    <input type="number" class="form-control" id="numero" name="numero" value="<?php echo $numero?>" placeholder="N&uacute;mero de comprobante"  maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" Required/>
                  </div>
                  <div class="form-group col-md-5">
                    <label>N&uacute;mero Serie</label>
                    <input type="number" class="form-control" id="serie" name="serie" value="<?php echo $serie?>" placeholder="N&uacute;mero de serie"  maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" Required/>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Tipo Comprobante</label>
                    <select id="idcompro" name="idcompro" class="form-control">
                      <option value="">Seleccione</option>
                      <?php foreach ($comprobante as $row):?>
                          <?php if (strval($row->id_comprobante)==strval($idcompro)): ?>
                              <option value="<?php echo $row->id_comprobante?>" selected ><?php echo $row->descripcion?></option>
                          <?php else:?>
                              <option value="<?php echo $row->id_comprobante?>"  ><?php echo $row->descripcion?></option>
                          <?php endif?>
                      <?php endforeach ?> 
                    </select>
                  </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-10">
                    <label>Proveedor</label>
                    <select id="idprovedor" name="idprovedor" class="form-control select2bs4" style="width: 100%;" name="cajero">
                       <option value="">Buscar proveedor...</option>
                        <?php foreach ($proveedor as $row):?>
                            <?php if (strval($row->Id)==strval($idproveedor)): ?>
                                <option value="<?php echo $row->Id?>" selected ><?php echo $row->DNI_RUC?> - <?php echo $row->Nombre?></option>
                            <?php else:?>
                                <option value="<?php echo $row->Id?>"  ><?php echo $row->DNI_RUC?> - <?php echo $row->Nombre?></option>
                            <?php endif?>
                        <?php endforeach ?> 
                      </select>
                </div>
                <div class="form-group col-md-2">
                  <span class="anadir_compras input-group-btn">
                    <a class="btn btn-success" onclick="mostrarPassword()"> 
                    Nuevo proveedor<span class="icon-add"></span>
                    </a>
                  </span>
                </div>
              </div>
            </section>
            <section id="div_2_modal" class="div_2_modal">
              <div class="form-row">
                <div class="form-group col-md-10">
                  <label>Producto</label>
                    <select id="id_producto" class="form-control select2bs4" style="width: 100%;">
                       <option value=""></option>
                        <?php foreach ($producto as $row):?>
                            <option value="<?php echo $row->Id?>"  ><?php echo $row->CodigoBarras?> - <?php echo $row->Descripcion?></option>
                        <?php endforeach ?> 
                    </select>
                </div>
                <div class="form-group col-md-2">
                  <span class="anadir_compras input-group-btn">
                    <a class="btn btn-success" onclick="anadir_producto()"> 
                    Agregar  <span class="icon-add"></span>
                    </a>
                  </span>
                </div>
              </div>
              <br>
                <table class="table tabla2">
                  <thead id="thead_dt_pro" class="thead_tabla2">
                    <tr> 
                      <th>#</th>
                      <th>Producto</th>
                      <th class="centrar">Cantidad</th>
                      <th class="centrar">Precio Compra</th>
                      <th class="centrar">Total</th>
                      <th class="centrar">Opciones</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_dt_pro" >
                  </tbody>
                </table>
              
            </section>
            <section style="display: block;" >
              <?php if(!empty($_SESSION['alert'])){?>
                <p class="mb-2">
                  <font color="red">
                      <?php echo($_SESSION['alert'])?>
                    </font>
                </p>
               <?php ;}?>
            </section>
            <br>
            <div class="botones_modal">
                    <button type="submit">Guardar <span class="icon-cloud_upload"></span></button>
                    <a  href="<?php echo base_url();?>/Marca" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
<script type="text/javascript">
  var lista=[];
  var HTML="";
  var loc_st=localStorage.getItem("lista");

  if (loc_st==null) {lista=[];}
  else{
    lista=JSON.parse(localStorage.getItem("lista"));

    lista.forEach(element => {
      HTML=HTML+`<tr><td>e</td><td>${element.datos}</td><td class='centrar'><input type="text" value="${element.cant}"></td><td class='centrar'><input type="text" value="${element.preciov}" step="any"></td><td class='centrar'>e</td><td class='centrar'><button onclick="elim_dcompra(${element.id});" class="icon-delete_forever elim_dcompra" title="Eliminar"></button></td></tr>`;
      $("#tbody_dt_pro").html(HTML);
    });
    var HTML="";
  }

</script>