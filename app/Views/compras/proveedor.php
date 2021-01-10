<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" >  

              <div class="card-header" id="card-header">
               <button type="button" class="btn_tablas" onclick="window.location='<?php echo base_url();?>/Proveedor/agregarViews'"><span class="icon-person_add"> </span>Nuevo Proveedor</a></button>
              </div>
            
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">
                    <tr> 
                      <th>#</th>
                      <th>Nombre</th>
                      <th class="centrar">DNI/RUC</th>
                      <th class="centrar">Celular/Telefono</th>
                      <th class="centrar">Estado</th>
                      <th class="centrar">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($proveedor)):?>
                    <?php $n=1;?>
                    <?php  foreach($proveedor as $linea):?>
                        <tr>
                          <td class="centrar"><?php echo $n;?></td>
                          <td><?php echo $linea->Nombre;?></td>
                          <td class="centrar"><?php echo $linea->DNI_RUC;?></td>
                          <td class="centrar"><?php echo $linea->Celular;?>/<?php echo $linea->Telefono;?></td>
                          <?php  
                              if ($linea->deleted_at==Null){ $estado="<span style='position: relative;left: -8px;' class='badge bg-success'>Activo</span>";}
                              else{$estado="<span style='position: relative;left: -9px;' class='badge bg-danger'>Inactivo</span>";}
                          ?>                 
                          <td class="centrar"><?php echo $estado;?></td>
                          <td>
                            <div class="e2_comision">
                                <button onclick="window.location='<?php echo base_url();?>/Proveedor/agregarViews?id=<?php echo base64_encode($linea->Id);?>'" class="icon-mode_edit editar" title="Editar" ></button>
                                <?php if ($linea->deleted_at==Null){?>    
                                <button  onclick="e2_proveedor('eliminar',<?php echo $linea->Id; ?>);" class="icon-delete_forever eliminar" title="Eliminar"></button>
                                <?php }else{?>
                                <button  onclick="e2_proveedor('activar',<?php echo $linea->Id; ?>);" class="icon-radio_button_checked activar" title="Activar"></button>
                                <?php }?>
                            </div>
                          </td>
                        </tr>
                        <?php $n=$n+1;?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
        </div>
      </div>
  </div>
</div>