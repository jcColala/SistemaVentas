<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
          <div class="card" id="card" > 
              <div class="card-body">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="inputEmail4">COMPROBANTE:</label>
                      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">SERIE:</label>
                      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">CORRELATIVO:</label>
                      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="inputPassword4">FECHA:</label>
                      <input type="text" class="form-control" id="inputPassword4" value="<?php ECHO date("Y-m-d H:i:s"); ?>" readonly >
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="">CLIENTE:</label>
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="text" class="form-control" id="cliente"  placeholder="Buscar" > 
                    </div>
                    <div class="form-group col-md-1">
                      <label for="">&nbsp;</label>
                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" onclick="agregarC()" ><span class="fa fa-plus"></span> <i class="fas fa-user"></i></button>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="">PRODUCTO:</label>
                        <input type="hidden" name="idcliente" id="idcliente">
                        <input type="text" class="form-control" id="cliente"  placeholder="Buscar" > 
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