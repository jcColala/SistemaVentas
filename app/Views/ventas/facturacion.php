<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="card" id="card" > 
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="comprobante_venta">COMPROBANTE:</label>

                        <select class="form-control" placeholder="Comprobante" id="comprobante_venta" name="comprobante_venta">
                          <option value="">SELECCIONE...</option>
                          <?php foreach ($comprobantes as $row):?>
                          <?php $datoscomp=$row->id_comprobante."*".$row->descripcion."*".$row->serie."*".$row->correlativo ?>
                          <option value="<?php echo $datoscomp?>" ><?php echo ($row->descripcion)?></option>                     <?php endforeach ?>
                        </select>
                    </div>
                    <input type="hidden" id="id_comprobante" name="id_comprobante">
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
                      <input type="text" class="form-control" id="inputPassword4" value="<?php ECHO date("Y-m-d H:i:s"); ?>" readonly >
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="">CLIENTE:</label>
                        <div class=" select2-primary" >
                          <select class="form-control select2bs4"  name="cajero" required>
                            <option value="">SELECCIONE...</option>
                            <?php foreach ($clientes as $row):?>
                              <option value="<?php echo $row->id_cliente?>"  ><?php echo ($row->nombre." ".$row->apellido)?> </option>  
                            <?php endforeach ?> 
                          </select>
                        </div> 
                    </div>
                    <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" onclick="agregarC()" ><span class="fa fa-plus"></span> <i class="fas fa-user"></i></button>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="">PRODUCTO:</label>
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="text" class="form-control" id="cliente"  placeholder="LEE EL CÓDIGO DE BARRAS O ESCRIBE EL CODIGO DEL PRODUCTO" > 
                    </div>
                    <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" onclick="agregarC()" ><span class="fa fa-plus"></span> <i class="fas fa-box-open"></i></button>
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
                                        <th>SUBTOTAL</th>
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
                            <span class="input-group-text" id="basic-addon1">TOTAL</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">IGV</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">DESCUENTO</span>
                          </div>
                          <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <button type="button" class="btn btn-success btn-flat" onclick="cancelar()">Procesar</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
  </div>
</div>
</div>