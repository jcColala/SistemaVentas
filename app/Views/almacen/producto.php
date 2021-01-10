<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" > 

              <div class="card-header" id="card-header">
               <button type="button" class="btn_tablas" onclick="window.location='<?php echo base_url();?>/Producto/agregarViews'"><span class="icon-add_circle"> </span>Nuevo Producto</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">
                    <tr>
                      <th>Codigo Barr.</th>
                      <th>Descripci&oacute;n</th>
                      <th class="centrar">Categor&iacute;a</th>
                      <th class="centrar">Stock</th>
                      <th class="centrar">Precio Vent</th>
                      <th class="centrar">Estado</th>
                      <th class="centrar">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($producto)):?>
                    <?php  foreach($producto as $linea):?>
                        <tr>
                          <td><?php echo $linea->CodigoBarras;?></td>
                          <td><?php echo $linea->Descripcion;?></td>
                          <td class="centrar"><?php echo $linea->NombreCat;?></td>
                          <td class="centrar"><?php echo $linea->Stock;?></td>
                          <td class="centrar"><?php echo $linea->PrecioVenta;?></td>
                          <?php  
                              if ($linea->deleted_at==Null){ $estado="<span style='position: relative;left: -8px;' class='badge bg-success'>Activo</span>";}
                              else{$estado="<span style='position: relative;left: -9px;' class='badge bg-danger'>Inactivo</span>";}
                          ?>                  
                          <td class="centrar"><?php echo $estado;?></td>
                          <td>
                            <div class="e2_comision">
                                <button onclick="window.location='<?php echo base_url();?>/Producto/agregarViews?id=<?php echo base64_encode($linea->Id);?>'" class="icon-mode_edit editar" title="Editar" ></button>
                                <?php if ($linea->deleted_at==Null){?>    
                                <button  onclick="e2_producto('eliminar',<?php echo $linea->Id; ?>);" class="icon-delete_forever eliminar" title="Eliminar"></button>
                                <?php }else{?>
                                <button  onclick="e2_producto('activar',<?php echo $linea->Id; ?>);" class="icon-radio_button_checked activar" title="Activar"></button>
                                <?php };?>
                                <button  onclick="ver_mas('<?php echo $linea->CodigoBarras; ?>','<?php echo $linea->Descripcion; ?>','<?php echo $linea->NombreCat; ?>','<?php echo $linea->Stock;?>','<?php echo $linea->PrecioVenta;?>','<?php echo $linea->deleted_at;?>');" class="icon-queue mas" title="Ver más"></button>
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
<div class="modal fade bd-example-modal-lg" id="ModalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: rgba(0,0,0,0.7);">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle del  Producto </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>&nbsp;</label>
            </div>
            <div class="form-group col-md-4">
                <section id="sec_codbrr" style="text-align: center;">
                </section>   
            </div>
        </div>
        <form  action="<?php echo base_url();?>/Producto/imprimir" method="post"  onsubmit="imprimir_cobarr(event)">
          <div class="form-row align-items-center">
            <div class="form-group col-md-4">
                    <label>&nbsp;</label>
                    <input type="hidden" name="codbarr" id="codbarr">
            </div>
            <div class="col-auto col-md-3">
              <label class="sr-only" for="cant">Username</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Cant.</div>
                </div>
                <input type="text" class="form-control" id="cant" name="cant" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="1">
              </div>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-2">Imprimir</button>
            </div>
          </div>
        </form>
        <br>
        <div class="card-group">
          <div class="card">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">CODIGO BARRAS</li>
              <li class="list-group-item">DESCRIPCI&Oacute;N</li>
              <li class="list-group-item">CATEGOR&Iacute;A</li>
              <li class="list-group-item">PRECIO VENTA</li>
              <li class="list-group-item">STOCK</li>
              <li class="list-group-item">ESTADO</li>
            </ul>
          </div>
          <div class="card">
            <ul class="list-group list-group-flush" id="ul_det_product">
            </ul>
          </div>
        </div>
        <br>   
      </div>
    </form>
    </div>
  </div>
</div>