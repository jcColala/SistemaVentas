<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" > 

              <div class="card-header" id="card-header">
               <button type="button" class="btn_tablas" onclick="window.location='<?php echo base_url();?>/TipoUsuario/agregarViews'"><span class="icon-person_add"> </span>Nuevo Tipo Usuario</button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">
                    <tr> 
                      <th>#</th>
                      <th>Descripci&oacute;n</th>
                      <th class="centrar">Estado</th>
                      <th class="centrar">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($t_usuario)):?>
                    <?php $n=1;?>
                    <?php  foreach($t_usuario as $linea):?>
                        <tr>
                          <td class="centrar"><?php echo $n;?></td>
                          <td><?php echo $linea->Descripcion;?></td>
                          <?php  
                              if ($linea->deleted_at==Null){ $estado="Activo";}
                              else{$estado="Inactivo";}
                          ?>                  
                          <td class="centrar"><?php echo $estado;?></td>
                          <td>
                            <div class="e2_comision">
                              <?php if ($linea->Id==1) {}else{?>
                                <button onclick="window.location='<?php echo base_url();?>/TipoUsuario/agregarViews?id=<?php echo base64_encode($linea->Id);?>'" class="icon-mode_edit editar" title="Editar" ></button>
                                <?php if ($linea->deleted_at==Null){?>    
                                <button  onclick="e2_t_usuario('eliminar',<?php echo $linea->Id; ?>);" class="icon-delete_forever eliminar" title="Eliminar"></button>
                                <?php }else{?>
                                <button  onclick="e2_t_usuario('activar',<?php echo $linea->Id; ?>);" class="icon-radio_button_checked activar" title="Activar"></button>
                                <?php }};?>
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