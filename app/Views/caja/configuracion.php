<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" > 
             
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">

                    <tr> 
                      <th>#</th>
                      <th>Descripción </th>
                      <th>Encargado </th>
                       
                      <th>Estado</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($cajas)):?>
                    <?php  foreach($cajas as $linea):?>
                        <tr>
                          <td ><?php echo $linea->id_caja;?></td>
                          <td  ><?php echo $linea->descripcion;?></td>
                          <td><?php echo $linea->Nombre?> <?php echo $linea->Apellidos?></td>
                          <td>
                          <div class="e2_comision">
                                <button onclick="" class="fas fa-tools editar" title="Editar"  data-toggle="modal" data-target="#ModalConfig"></button>
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

<div class="modal fade bd-example-modal-lg" id="ModalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Registro </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form   id="form_configcaja" >
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Descripción</label>
               <?php  foreach($cajas as $linea):?>
                <input type="hidden" id="idcaja_config" name="idcaja_config" value="<?php echo $linea->id_caja;?>">
              <input type="text" class="form-control" name="caja_config" id="caja_config"  placeholder="" value="<?php echo $linea->descripcion;?>" >
               <?php endforeach; ?>
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Encargado</label>
              <div class=" select2-primary" >
                  <select class="form-control select2bs4"  name="cajero" required>
                     <?php foreach ($cajeros as $row):?>
                          <?php  foreach($cajas as $linea):?>
                            <?php $cajeroSelect=$linea->id_usuario?>
                          <?php endforeach; ?>
                          <?php if (strval($row->Idusuario)==strval($cajeroSelect)): ?>  
                          <option value="<?php echo $row->Idusuario?>" selected ><?php echo ($row->Nombre." ".$row->Apellidos)?> </option>  
                          <?php else:?>
                          <option value="<?php echo $row->Idusuario?>"  ><?php echo ($row->Nombre." ".$row->Apellidos)?> </option>  
                          <?php endif?>                      
                     <?php endforeach ?> 
                  </select>
              </div>
            </div>
          </div>
          <h6 class="modal-title" id="exampleModalLongTitle">Comprobantes:</h6>
          <br>
          <div class="form-row">
            <div class="col-md-5 mb-2">
              <select class="form-control" placeholder="Comprobante" id="comprobante_config">
                      
                      <?php foreach ($comprobantes as $row):?>
                        <?php $datoscomp=$row->id_comprobante."*".$row->descripcion ?>
                          <option value="<?php echo $datoscomp?>" ><?php echo ($row->descripcion)?> </option>                         
                     <?php endforeach ?>
              </select>
            </div>
            <div class="col-md-3 mb-2 ">

              <input type="text" class="form-control"  onkeypress="return Letras_numeros(event);" placeholder="Serie" id="serie_config">
            </div>
            <div class="col-md-3 mb-2">
              <input type="text" class="form-control" onkeypress="return Letras_numeros(event);" placeholder="correlativo" id="correlativo_config">
            </div>
            <div class="col-md-1 ">
              <button type="button" onclick="mostrarp()"  class="btn btn-success"><i class="fas fa-plus" ></i></button>
            </div>
          </div> 
          <br>
          <div class="row">
            <div class="col-md-12" style="width: 600px;overflow-y: scroll;">
              <table class="table table-striped table-bordered"  id="exampleReport"  >
              <thead>
                <tr>
                  <th scope="col">Comprobante</th>
                  <th scope="col">Serie</th>
                  <th scope="col">Correlativo</th>
                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php  if (!empty($detalle_caja)):?>
                    <?php  foreach($detalle_caja as $linea):?>
                        <tr>
                          <td ><input type='hidden' name=id_comprobante[] id="id_comprobante[]" value=<?php echo $linea->id_comprobante?> readonly><?php echo $linea->descripcion?></td>
                          <td ><input type='text' name="serie[]"  id="serie[]" onkeypress="return Letras_numeros(event);" value=<?php echo $linea->serie?>  ></td>
                          <td ><input type='text' name=correlativo[] id="correlativo[]"  onkeypress="return Letras_numeros(event);"  value=<?php echo $linea->correlativo?> ></td>
                         
                          <td>

                                <button type='button' class='btn btn-danger btn-remove-comprobante' ><span class='fas fa-trash-alt'></span></button>
                           
                          </td>  
                        </tr>
                        
                  <?php endforeach; ?>
                  <?php endif; ?>
              </tbody>
          </table>
          
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="procesar_caja_cofig()" class="btn btn-primary">Actualizar</button>
      </div>
    </form>
    </div>
  </div>
</div>
