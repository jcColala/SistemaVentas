<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" > 
        <h4>Registrar Tipo Usuario</h4> 
 
        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',1);" id="span_selec_1" class="span_selec_1">Datos B&aacute;sicos</span>
        </section>

        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/TipoUsuario/agregar" method="post" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <section id="div_1_modal" class="div_1_modal">
                  <div class="form-group col-md-12">
                    <label>Descripci&oacute;n</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion?>" placeholder="Descripci&oacute;n" Required />
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
                    <a  href="<?php echo base_url();?>/TipoUsuario" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>