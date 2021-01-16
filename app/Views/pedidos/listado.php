<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
        <div class="card" id="card" >  
              <div class="card-body" id="card-body-atencion">
                <table id="example1" class="table table-bordered table-striped">
                  <?php  foreach($caja as $linea):?>
                  <input type="hidden" id="monto_caja"  value="<?php echo $linea->monto?>">
                  <?php endforeach; ?>
                  <thead class="thead_tabla">
                    <tr> 
                      <th>#</th>
                      <th>CLIENTE</th>
                      <th>USUARIO</th>
                      <th class="centrar">COMPROBANTE</th>
                      <th class="centrar">ESTADO</th>
                       <th class="centrar">OPCION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($pedidos)):?>
                      <?php  foreach($pedidos as $linea):?>
                        <tr>
                          <td ><?php echo $linea->id_pedido?></td>
                          <td ><?php echo $linea->nombre?> </td>
                          <td ><?php echo $linea->Nombre?> <?php echo $linea->Apellidos?></td>
                          <td ><?php echo $linea->descripcion?></td>

                          <?php if($linea->estadopedido==null):?>
                           <td ><span class="badge badge-warning">
                           Pendiente</span></td>
                          <?php elseif($linea->estadopedido==1): ?>
                           <td ><span class="badge badge-success">Procesado</span></td>
                          <?php elseif($linea->estadopedido==2 OR $linea->estadopedido==3): ?>
                            <td ><span class="badge badge-danger">Eliminado</span></td>
                          <?php endif ?>
                          <td>
                            <div class="e2_comision">
                                <button class="fas fa-eye editar"   data-toggle="modal" data-target="#modelDettalleVenta"  onclick="verPedidoCompleto(<?php echo($linea->id_pedido);?>,'modelDettalleVenta' )"  title="Ver"></button>
                                <?php if($linea->estadopedido==null):?>
                                    
                                   <button class="icon-mode_edit  activar" data-toggle="modal" data-target="#modelprocesarVenta"title="Procesar" onclick="verPedidoCompleto(<?php echo($linea->id_pedido);?>,'modelprocesarVenta')" ></button>

                                    <button class="icon-delete_forever eliminar" id="btn_eliminar_cliente" onclick="eliminar_pedido(<?php echo $linea->id_pedido ?>)" title="Eliminar"></button>
                                 
                                         
                                <?php endif ?> 
                                
                            </div>
                          </td>  
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="modelDettalleVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Información de la venta.</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="row">
          <div class="col-sm-12 text-center">
            <b>Empresa de Ventas</b><br>
            Calle Moquegua 430 <br>
            Tel. 481890 <br>
            Email:yonybrondy17@gmail.com
          </div>
        </div> <br>
        <div class="row">
          <div class="col-sm-6">  
            <b>CLIENTE</b><br>
            <b>Nombre:</b> Yony Brondy <br>
            <b>Nro Documento:</b> 45454546<br>
            <b>Telefono:</b> 454545 <br>
            <b>Direccion</b> Ilo,miramar<br>
          </div>  
          <div class="col-sm-6">  
            <b>COMPROBANTE</b> <br>
            <b>Tipo de Comprobante:</b> Boleta<br>
            <b>Serie:</b> 001<br>
            <b>Nro de Comprobante:</b> 000001<br>
            <b>Fecha</b> 17/12/1990
          </div>  
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Importe</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>0001</td>
                  <td>Coca Cola de 2.5L</td>
                  <td>6.50</td>
                  <td>10</td>
                  <td>65.00</td>
                </tr>
                
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                  <td>65.00</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"><strong>IGV:</strong></td>
                  <td>11.70</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"><strong>Descuento:</strong></td>
                  <td>0.00</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right"><strong>Total:</strong></td>
                  <td>76.70</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div> -->
      </div>
     
    </div>
  </div>
</div>
<div class="modal fade" id="modelprocesarVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Información de la venta.</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="container">
         <div class="row">
          <div class="col-sm">
              <form>

                <div class="form-row">
                  <div class="col-sm-6">
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary3" >
                        <label for="checkboxPrimary3">
                         Enviar a SUNAT
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="form-row">
                   <div class="form-group col-md-4">
                      <label for="monto_pago">MONTO DE PAGO</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" name="monto_pago" id="monto_pago"  onkeypress='return numeros_precios(event);'>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">TOTAL VENTA</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" name="total_pago" id="total_pago" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">VUELTO</label>
                        <div class="input-group input-group">
                          <input type="text" class="form-control" name="vuelto_pago" id="vuelto_pago" readonly>
                        </div>
                    </div>
                 </div> 
              </form>
          </div>
         </div>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button class="btn btn-primary" onclick="listProcesarVenta()" role="button">PROCESAR E IMPRIMIR</button>
        
      </div>
    </div>
  </div>
</div>