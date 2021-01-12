<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="card" id="card" >  
        <h4>Registrar Producto</h4>
 
        <section class="padr_menu_datos">
          <span  onclick="seleccionar('div_1_modal','span_selec_1',1);" id="span_selec_1" class="span_selec_1">Datos B&aacute;sicos</span> 
        </section>

        <div class="padre_cont_datos" id="padre_cont_datos">
          <br>
          <form  action="<?php echo base_url();?>/Producto/agregar" method="post" >
            <br>
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="compra" id="compra" value="<?php echo $compra?>"> 
            <section id="div_1_modal" class="div_1_modal">
              <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Codigo de Barras</label>
                    <input type="text" style="color: #495057a6;" readonly=»readonly» class="form-control" id="codigobrr" name="codigobrr" value="<?php echo $codigobrr?>"/>
                  </div>
                  <div class="form-group col-md-9">
                    <label>Descripci&oacute;n</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion?>" placeholder="Descripci&oacute;n" Required/>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-10">
                    <label for="inputState">Categor&iacute;a</label>
                    <select id="idcategoria" name="idcategoria" class="form-control">
                      <option value="">Seleccione</option>
                      <?php foreach ($categoria as $row):?>
                          <?php if (strval($row->Id)==strval($idcategoria)): ?>
                              <option value="<?php echo $row->Id?>" selected ><?php echo $row->Descripcion?></option>
                          <?php else:?>
                              <option value="<?php echo $row->Id?>"  ><?php echo $row->Descripcion?></option>
                          <?php endif?>
                      <?php endforeach ?> 
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                      <label for="">&nbsp;</label>
                        <a href="<?php echo base_url();?>/Categoria/agregarViews?com=v" id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block" ><span class="fa fa-plus"></span> <i class="fas fa-box-open"></i></a>
                  </div>
                </div>  
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Stock</label>
                    <input type="number" style="color: #495057a6;" readonly=»readonly» class="form-control" id="stock" name="stock" value="<?php echo $stock?>" placeholder="0"/>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Precio Compra</label>
                    <input type="number" readonly=»readonly» class="form-control" id="preciocompra" name="preciocompra" value="<?php echo $preciocompra?>" placeholder="0.00" />
                  </div>
                  <div class="form-group col-md-4">
                    <label>Precio Venta</label>
                    <input type="number" readonly=»readonly» class="form-control" id="precioventa" name="precioventa" value="<?php echo $precioventa?>" placeholder="0.00" />
                  </div>
                </div>
                  
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
                    <a  href="javascript:history.back()" id="bt_cancelar_modal" >Cancelar <span class=" icon-close"></span></a>
            </div> 
          </form>
        </div>
      </div>
  </div>
</div>