<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" > 
             <div class="card-header" id="card-header">
                <?php  foreach($cajas as $linea):?>
                    <?php if($linea->estadocaja==null): ?>
               <button type="button" class="btn_tablas"  data-toggle="modal" data-target="#exampleModalCenter" >
                <span class="fas fa-lock"></span>  Abrir Caja</button>
              </div>
              <?php else: ?>
              <div class="card-header" >
               <a href="<?php echo base_url();?>/Caja/cerrar" class="btn btn-outline-danger" role="button" data-bs-toggle="button"><span class="fas fa-lock-open"></span>  Cerrar Caja</a>
              </div>
              <?php endif; ?>
               <?php endforeach; ?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">

                    <tr> 
                      <th>#</th>
                      <th>Descripción </th>
                      <th>Encargado </th>
                       <th>Monto Inicial </th>
                      <th>Estado</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($cajas)):?>
                    <?php  foreach($cajas as $linea):?>
                        <tr>
                          <td  class="centrar"><?php echo $linea->id_caja;?></td>
                          <td  class="centrar"><?php echo $linea->descripcion;?></td>
                          <td class="centrar"><?php echo $linea->Nombre?> <?php echo $linea->Apellidos?></td>
                          <td class="centrar"><?php echo $linea->monto;?></td>
                          <?php if($linea->estadocaja==null): ?>
                          <td  class="centrar"><span class="badge bg-danger">Inactivo</span></td>
                          <?php else: ?>
                            <td  class="centrar"><span class="badge bg-success">Activado</span></td>
                          <?php endif; ?>
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Valores Iniciales </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form   action="<?php echo base_url();?>/Caja/add" method="post" >
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Monto Inicial</label>
              <div class="col-sm-8">
                <div class="input-group">
                <input type="text" class="form-control" name="monto">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Encargado</label>
              <div class="col-sm-8 select2-primary" >
                  <select class="form-control select2bs4" style="width: 100%;" name="cajero">
                    <option selected="selected"></option>
                     <?php foreach ($cajeros as $row):?>
                          
                          <option value="<?php echo $row->Idusuario?>" ><?php echo ($row->Nombre." ".$row->Apellidos)?> </option>
                          
                         
                     <?php endforeach ?> 
                  </select>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>