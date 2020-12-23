<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" > 
        <h4>Registrar Usuario</h4>

        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',2);" id="span_selec_1" class="span_selec_1">Datos B&aacute;sicos</span>
          <span  onclick="seleccionar('div_2_modal','span_selec_2',2);" id="span_selec_2" class="span_selec_2">Otros Datos</span>
        </section>
 
        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/Usuario/agregar" method="post" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <section id="div_1_modal" class="div_1_modal">
               <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>" placeholder="Nombre" Required />
                  </div>
                  <div class="form-group col-md-5">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos?>" placeholder="Apellidos" Required/>
                  </div>
                  <div class="form-group col-md-3">
                    <label>DNI</label>
                    <input type="number" class="form-control" id="dni" name="dni" value="<?php echo $dni?>" placeholder="DNI"  maxlength="8" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" Required/>
                  </div>
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario?>" placeholder="Usuario" Required/>
                  </div>
                  <div class="form-group col-md-5">
                    <label>Clave</label>
                    <input type="text" class="form-control" id="clave" name="clave" value="<?php echo $clave?>" placeholder="Password" Required/>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputState">Tipo</label>
                    <select id="mtipo" name="mtipo" class="form-control">
                      <option value="">Seleccione</option>
                      <?php foreach ($tipo as $row):?>
                          <?php if (strval($row->Id)==strval($mtipo)): ?>
                              <option value="<?php echo $row->Id?>" selected ><?php echo $row->Descripcion?></option>
                          <?php else:?>
                              <option value="<?php echo $row->Id?>"  ><?php echo $row->Descripcion?></option>
                          <?php endif?>
                      <?php endforeach ?> 
                    </select>
                  </div>
                </div>  
            </section>
            <section id="div_2_modal" class="div_2_modal">
              <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo?>" placeholder="Correo">
                  </div>
                  <div class="form-group col-md-5">
                    <label>Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" value="<?php echo $celular?>" placeholder="Celular">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="inputState">Sexo</label>
                    <select id="sexo" name="sexo" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="M" <?php if ($sexo=='M'){ echo "selected";}?>>Mujer</option>
                      <option value="H" <?php if ($sexo=='H'){ echo "selected";}?>>Hombre</option>
                    </select>
                  </div>
              </div>
              <div class="form-group col-md-13">
                    <label>Direcci&oacute;n</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion?>" placeholder="Direcci&oacute;n">
              </div>
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fechaN" name="fechaN" value="<?php echo $fechaN?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Fecha Ingreso</label>
                  <input type="date" class="form-control" id="fechaI" name="fechaI" value="<?php echo $fechaI?>">
                </div>
              </div>   
            </section>
            <section id="div_3_modal" class="div_3_modal">
              <a href="#">d</a>
            </section>
            <section style="display: block;" >
              <?php if(!empty($_SESSION['alert'])){?>
                <p class="mb-2">
                  <font color="red">
                      <?php echo($_SESSION['alert'])?>
                    </font>
                </p>
               <?php ;}?>
            </section>
            <br>
            <div class="botones_modal">
                    <button type="submit">Guardar <span class="icon-cloud_upload"></span></button>
                    <a  href="<?php echo base_url();?>/Usuario" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>