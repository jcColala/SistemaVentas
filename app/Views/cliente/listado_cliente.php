<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">

          <div class="card" id="card" >  

              <div class="card-header" id="card-header">
               <button type="button" class="btn_tablas" onclick="window.location='<?php echo base_url();?>/ClientesController/agregarViews'"><span class="icon-person_add"> </span>NUEVO CLIENTE</a></button>
              </div>
              <?php if(!empty($_SESSION['alert_ingreso_cliente'])){
            echo($_SESSION['alert_ingreso_cliente']);

          }?>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead class="thead_tabla">
                    <tr> 
                      <th>#</th>
                      <th>TIPO</th>
                      <th>NOMBRE</th>
                      <th class="centrar">APELLIDOS</th>
                      <th class="centrar">DNI/RUC</th>
                      <th class="centrar">TELÉFONO</th>
                      <th class="centrar">OPCIONES</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php  if (!empty($clientes)):?>
                    <?php  foreach($clientes as $linea):?>
                        <tr>
                          <td ><?php echo $linea->id_cliente?></td>
                          <td ><?php echo $linea->tipo_descripcion?></td>
                          <td ><?php echo $linea->nombre?></td>
                          <td ><?php echo $linea->apellido?></td>
                          <td ><?php echo $linea->dni_ruc?></td>
                          <td ><?php echo $linea->telefono?></td>
                          <td>
                            <div class="e2_comision">
                                <button class="icon-mode_edit editar" onclick="window.location='<?php echo base_url();?>/ClientesController/agregarViews?id=<?php echo base64_encode($linea->id_cliente);?>'" title="Editar" ></button>
                                <?php if ($linea->estadocliente==Null){?>    
                                <button class="icon-delete_forever eliminar" id="btn_eliminar_cliente" onclick="eliminar_cliente(<?php echo $linea->id_cliente ?>,'E')" title="Eliminar"></button>
                                <?php }else{?>
                                <button class=" icon-radio_button_checked activar"  id="btn_activar_cliente" onclick="activar_cliente(<?php echo $linea->id_cliente ?>,'A')" title="Activar"></button>
                                <?php }?>
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