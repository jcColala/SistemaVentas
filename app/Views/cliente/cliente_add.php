<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" >
        <div class="card-header" id="card-header">
          <div class="row">
            <div class="col-8">
               <h4>Registrar Cliente</h4>
            </div>
            <div class="col-2">
               <button type="button" class="btn btn-secondary " onclick="valdni();"><i class="fas fa-search"></i>RENIEC</button>
            </div>
            <div class="col-2">
              <button type="button" class="btn btn-secondary" onclick="valsunat();"><i class="fas fa-search"></i>SUNAT</button>
            </div>
          </div>
           

        </div> 
       <br>
        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',2);" id="span_selec_1" class="span_selec_1">Datos B&aacute;sicos</span>

        </section>
        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/ClientesController/agregar" method="post" >
            <br>
            <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_cliente?>">
            <section id="div_1_modal" class="div_1_modal">
               <div class="form-row">
                  <div class="form-group col-md-2">
                    <label for="inputState">TIPO</label>
                    <select id="tipo_cliente" name="tipo_cliente" class="form-control" required>
                      <option value="">SELECCIONE</option>
                      <?php foreach ($idtipo_cliente as $row):?>
                        <?php if($row->idtipo_cliente==$tipo_cliente):?>
                          <option value="<?php echo $row->idtipo_cliente?>" selected ><?php echo ($row->tipo_descripcion)?></option>
                          <?php else: ?>
                          <option value="<?php echo $row->idtipo_cliente?>" ><?php echo ($row->tipo_descripcion)?></option>
                        <?php endif?>  
                      <?php endforeach ?>
                        </select>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label>DNI/RUC</label>
                    <input type="number" class="form-control" id="dni_cliente" name="dni_cliente" value="<?php echo $dni_ruc?>" placeholder="DNI/RUC"  maxlength="8" Required/>
                  </div>
                  <div class="form-group col-md-8">
                    <label>NOMBRE/EMPRESA</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" value="<?php echo $nombre?>" placeholder="NOMBRE" Required />
                  </div>
                  
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label>CELULAR</label>
                    <input type="text" class="form-control" id="celular_cliente" name="celular_cliente" value="<?php echo $telefono?>" placeholder="CELULAR" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>CORREO</label>
                    <input type="text" class="form-control" id="correo_cliente" name="correo_cliente" value="<?php echo $correo?>" placeholder="CORREO" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>DIRECCIÓN</label>
                    <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" value="<?php echo $direccion?>" placeholder="DIRECCIÓN" />
                  </div>
                  <div class="form-group col-md-2">
                    <label>SEXO</label>
                    <select id="sexo_cliente" name="sexo_cliente" class="form-control">
                      <option value="">SELECCIONE</option>
                      <option value="M" <?php if ($sexo=='M'){ echo "selected";}?>>MUJER</option>
                      <option value="H" <?php if ($sexo=='H'){ echo "selected";}?>>HOMBRE</option>
                    </select>
                  </div>
                </div>  
            </section>
            <br>
            <section style="display: block;" >
              <?php if(!empty($_SESSION['alert'])){?>
                <p class="mb-2">
                  <font color="red">
                      <?php echo($_SESSION['alert'])?>
                    </font>
                </p>
               <?php ;}?>
            </section>
            <div class="botones_modal">
                    <button type="submit">Guardar <span class="icon-cloud_upload"></span></button>
                    <a  href="<?php echo base_url();?>/ClientesController" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>