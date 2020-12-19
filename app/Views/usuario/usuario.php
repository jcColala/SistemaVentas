<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" > 

              <div class="card-header" id="card-header">
               <button type="button" class="btn_tablas" onclick="nueva_usuario();"><span class="icon-person_add"> </span>Nuevo Usuario</button>
              </div>
            
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">
                    <tr> 
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th class="centrar">DNI</th>
                      <th class="centrar">Nick</th>
                      <th class="centrar">Estado</th>
                      <th class="centrar">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if (!empty($usuario)):?>
                    <?php $n=1;?>
                    <?php  foreach($usuario as $linea):?>
                        <tr>
                          <td class="centrar"><?php echo $n;?></td>
                          <td><?php echo $linea->Nombre;?></td>
                          <td><?php echo $linea->Apellidos;?></td>
                          <td class="centrar"><?php echo $linea->DNI;?></td>
                          <td class="centrar"><?php echo $linea->Login;?></td>
                          <?php  
                              if ($linea->Estado==1){ $estado="Activo";}
                              else{$estado="Inactivo";}
                          ?>                  
                          <td class="centrar"><?php echo $estado;?></td>
                          <td>
                            <div class="e2_comision">
                                <button  onclick="e2_usuario('ed',<?php echo $linea->Id; ?>);" class="icon-mode_edit editar" title="Editar" ></button>
                                <?php if ($linea->Estado==1){?>    
                                <button  onclick="e2_usuario('el',<?php echo $linea->Id; ?>);" class="icon-delete_forever eliminar" title="Eliminar"></button>
                                <?php }else{?>
                                <button  onclick="e2_usuario('ac',<?php echo $linea->Id; ?>);" class="icon-radio_button_checked activar" title="Activar"></button>
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