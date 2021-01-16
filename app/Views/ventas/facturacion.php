<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="card" id="card" > 
              <div class="card-body">
                <form action="<?php echo base_url();?>/VentasController/fpdf" method="POST"  id="form_venta" >
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="comprobante_venta">COMPROBANTE:</label>

                        <select class="form-control" placeholder="Comprobante" id="comprobante_venta" name="comprobante_venta" >
                          <option value="">SELECCIONE...</option>
                          <?php foreach ($comprobantes as $row):?>
                          <?php $datoscomp=$row->id_comprobante."*".$row->descripcion."*".$row->serie."*".$row->correlativo."*".$row->igv."*".$row->iddetalle_ccomprobante ?>
                          <option value="<?php echo $datoscomp?>" ><?php echo ($row->descripcion)?></option>                     <?php endforeach ?>
                        </select>
                    </div>
                    <input type="hidden" id="id_comprobante" name="id_comprobante">
                     <input type="hidden" id="iddetalle_comprobante" name="iddetalle_comprobante">
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">SERIE:</label>
                      <input type="text" class="form-control" name="serie_venta" id="serie_venta" placeholder="SERIE" readonly>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="correlativo">CORRELATIVO:</label>
                      <input type="text" class="form-control" id="correlativo_venta" name="correlativo_venta" name="correlativo_venta" placeholder="CORRELATIVO" readonly>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">FECHA:</label>
                      <input type="text" class="form-control" id="fecha_venta" name="fecha_venta" value="<?php ECHO date("Y-m-d H:i:s"); ?>" readonly >
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">DNI/RUC:</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" name="doc_venta" id="doc_venta">
                          <span class="input-group-append">
                            <button id="btn-busquedad" type="button" class="btn btn-info btn-flat">Buscar</button>
                          </span>
                        </div>
                    </div>
                   
                    <div class="form-group col-md-5">
                      <label for="">NOMBRE/RAZ.SOC</label>
                        <input type="text" class="form-control" name="nombre_venta" id="nombre_venta">
                        <input type="hidden" name="n_venta" id="n_venta" value="">
                        <input type="hidden" name="a_venta" id="a_venta" value="">
                    </div>
                    
                    <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" data-toggle="modal" data-target="#modalclientepedido"><span class="fa fa-plus"></span> <i class="fas fa-user"></i></button>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="">DIRECCIÓN:</label>
                        <input type="text" class="form-control"  name="direccion_venta" id="direccion_venta" value=""> 
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="">PRODUCTO:</label>
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="text" class="form-control" id="producto_venta"  placeholder="LEE EL CÓDIGO DE BARRAS O ESCRIBE EL CODIGO DEL PRODUCTO" > 
                    </div>
                    <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" onclick="agregarproductoventa();"  ><span class="fa fa-plus" ></span> <i class="fas fa-box-open" ></i></button>
                    </div>
                  </div>
                  <table id="tbventas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>PRECIO COMPRA</th>
                                        <th>PRECIO</th>
                                        <th>STOCK</th>
                                        <th>CANTIDAD</th>
                                        <th>IMPORTE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                  </table>
                  <div class="form-row">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">SUBTOTAL</span>
                          </div>
                          <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="TOTAL"  aria-describedby="basic-addon1" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">IGV</span>
                          </div>
                          <input type="hidden" name="v_igv" id="v_igv">
                          <input type="text" class="form-control" placeholder="IGV" aria-label="Username"
                          name="igv_venta" id="igv_venta" aria-describedby="basic-addon1" readonly>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">DESCUENTO</span>
                          </div>
                          <input type="text" class="form-control" name="descuento_venta" id="descuento_venta" value=0 placeholder="DESCUENTO" aria-label="Username" aria-describedby="basic-addon1" onkeypress='return numeros_precios(event);'>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">TOTAL</span>
                          </div>
                          <input type="text" class="form-control" name="total_venta" id="total_venta" placeholder="TOTAL" aria-label="Username" aria-describedby="basic-addon1" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-3">
                       <button type="button" class="btn btn-success btn-flat" onclick="procesarpedido();"  >Procesar</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
  </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalclientepedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">REGISTRAR CLIENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-2">
               <button type="button" class="btn btn-secondary " onclick="valdni();"><i class="fas fa-search"></i>RENIEC</button>
            </div>
            <div class="col-2">
              <button type="button" class="btn btn-secondary" onclick="valsunat();"><i class="fas fa-search"></i>SUNAT</button>
            </div>
          </div>
          <div class="row">
            <form  id="formmodelcliente"  >
            <br>
            <input type="hidden" name="id_cliente" id="id_cliente" value="">
            <section id="div_1_modal" class="div_1_modal">
               <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="inputState">TIPO</label>
                    <select id="tipo_cliente" name="tipo_cliente" class="form-control" required>
                      <option value="">SELECCIONE</option>
                      <?php foreach ($idtipo_cliente as $row):?>
                          <option value="<?php echo $row->idtipo_cliente?>" ><?php echo ($row->tipo_descripcion)?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>DNI/RUC</label>
                    <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" value="" placeholder="DNI/RUC" onkeypress='return Numeros(event);' maxlength="11" Required/>
                  </div>
                  <div class="form-group col-md-8">
                    <label>NOMBRE/EMPRESA</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="" placeholder="NOMBRE" Required />
                  </div>
                  
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label>CELULAR</label>
                    <input type="text" class="form-control" id="celular_cliente" name="celular_cliente" value="" placeholder="CELULAR" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>CORREO</label>
                    <input type="text" class="form-control" id="correo_cliente" name="correo_cliente" value="" placeholder="CORREO" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>DIRECCIÓN</label>
                    <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" value="" placeholder="DIRECCIÓN" />
                  </div>
                  <div class="form-group col-md-2">
                    <label>SEXO</label>
                    <select id="sexo_cliente" name="sexo_cliente" class="form-control">
                      <option value="">SELECCIONE</option>
                       <option value="M">MUJER</option>
                      <option value="H">HOMBRE</option>
                    </select>
                  </div>
                </div>  
            </section>
            <br>
            
           
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="button" class="btn btn-primary" onclick="guardarclienteventa();">GUARDAR</button>
      </div>
     </form> 
    </div>
  </div>
</div>
<div id="contenedor" class="contenedor">
      <div class="loader" id="loader">Loading...</div>
</div>