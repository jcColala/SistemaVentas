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
          <form  id="formulario_d_compras" action="<?php echo base_url();?>/Compra/agregar" method="post"  onsubmit="guardr_det_compra(event)" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <section id="div_1_modal" class="div_1_modal">
              <br>
              <div class="form-row">
                  <div class="form-group col-md-5">
                    <label for="inputState">Tipo Comprobante</label>
                    <select id="idcompro" name="idcompro" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="B">Boleta</option>
                      <option value="F">Factura</option>
                    </select>
                  </div>
                  <div class="form-group col-md-1">
                    <label>&nbsp;</label>
                  </div>
                  <div class="form-group col-md-3">
                    <label>N&uacute;mero Comprobante</label>
                    <input type="number" class="form-control" id="numero" name="numero" value="<?php echo $numero?>" placeholder="N&uacute;mero de comprobante"  maxlength="20" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                  </div>
                  <div class="form-group col-md-3">
                    <label>N&uacute;mero Serie</label>
                    <input type="text" class="form-control" id="serie" name="serie" value="<?php echo $serie?>" placeholder="N&uacute;mero de serie" />
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
                      <label for="">&nbsp;</label>
                        <a href="<?php echo base_url();?>/Proveedor/agregarViews?com=v" id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> <i class="fas fa-user"></i></a>
                </div>
              </div>
            </section>
            <section id="div_2_modal" class="div_2_modal">
              <div class="form-row">
                <div class="form-group col-md-7">
                  <label>Producto</label>
                    <select onchange="agregarProd(this)" id="id_producto" class="form-control select2bs4" style="width: 100%;" autocomplete="off">

                       <option value="">Buscar Producto...</option>
                        <?php foreach ($producto as $row):?>
                            <option value="<?php echo $row->Id?>"  ><?php echo $row->CodigoBarras?> - <?php echo $row->Descripcion?></option>
                        <?php endforeach ?> 
                    </select>
                </div>
                <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <a href="<?php echo base_url();?>/Producto/agregarViews?com=v" id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" ><span class="fa fa-plus"></span> <i class="fas fa-box-open"></i></a>
                </div>
                <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                </div>
                <div class="col-md-3">
                      <label for="">&nbsp;</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">TOTAL </span>
                          </div>
                          <input type="text" class="form-control" readonly="»readonly»" id="total_compra" style="text-align: center; font-size:18px;background: #fff;" value="S/. 0.00">
                      </div>
                    </div>
              </div>
              <br>
                <table class="table tabla2">
                  <thead id="thead_dt_pro" class="thead_tabla2">
                    <tr> 
                      <th class="centrar">#</th>
                      <th class="centrar">CANT.</th>
                      <th>DESCRIPCION</th>
                      <th class="centrar">P.UNITARIO</th>
                      <th class="centrar">SUB TOTAL</th>
                      <th class="centrar">OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody id="tbody_dt_pro" >
                  </tbody>
                </table>
            </section>
            <section style="display: block;" >
              <?php if(!empty($_SESSION['alert'])){?>
                <p class="mb-2"  >
                  <font color="red" id="m_error">
                      <?php echo($_SESSION['alert'])?>
                    </font>
                </p>
               <?php ;}?>
            </section>
            <br>
            <div class="botones_modal" id="botones_modal">
                    <button type="submit" >Guardar <span class="icon-cloud_upload"></span></button>
                    <a  href="javascript:history.back()" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
<div id="contenedor" class="contenedor">
      <div class="loader" id="loader">Loading...</div>
</div>
<script type="text/javascript">
  var lista=[];
  var loc_st=localStorage.getItem("lista");
  if (loc_st==null) {lista=[];}
  else{
    lista=JSON.parse(localStorage.getItem("lista"));
    crear_lista();
  }

</script>