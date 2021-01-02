<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="card" id="card" > 
              <div class="card-body">
                <form action="<?php echo base_url();?>/VentasController/procesarVenta" method="POST"  id="form_venta" >
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
                            <button id="btn-busquedad" type="button" class="btn btn-info btn-flat">RENIEC</button>
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
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" onclick="agregarC()" ><span class="fa fa-plus"></span> <i class="fas fa-user"></i></button>
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
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"  ><span class="fa fa-plus"></span> <i class="fas fa-box-open"></i></button>
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
                       <button type="submit" class="btn btn-success btn-flat" >Procesar</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
  </div>
</div>
</div>