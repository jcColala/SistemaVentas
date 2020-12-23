<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" > 
        <h4>Registrar Proveedor</h4>

        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',1);" id="span_selec_1" class="span_selec_1">Datos B&aacute;sicos</span>
        </section>
 
        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/Proveedor/agregar" method="post" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <section id="div_1_modal" class="div_1_modal">
               <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>DNI/RUC</label>
                    <input type="number" class="form-control" id="dni_ruc" name="dni_ruc" value="<?php echo $dni_ruc?>" placeholder="DNI/RUC"  maxlength="11" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" Required/>
                  </div>
                  <div class="form-group col-md-9">
                    <label>Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>" placeholder="Nombre..." Required />
                  </div>
                </div> 
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Celular</label>
                    <input type="number" class="form-control" id="celular" name="celular" value="<?php echo $celular?>" placeholder="Celular" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Tel&eacute;fono</label>
                    <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono?>" placeholder="Tel&eacute;fono" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo?>" placeholder="Correo@gmail.com" Required>
                  </div>
                </div>
                <div class="form-group col-md-13">
                    <label>Direcci&oacute;n</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion?>" placeholder="Direcci&oacute;n" Required>
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
                    <a  href="<?php echo base_url();?>/Proveedor" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>