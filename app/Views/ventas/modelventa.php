
<div class="row">
	<input type="hidden" name="idventaProcesar" id="idventaProcesar" value="<?php echo($ventaU->id_venta)?>">
	<div class="col-sm-6">	
		<b>CLIENTE</b><br>
		<b>NOMBRE/RAZ.SOC:</b><?php echo($ventaU->nombre)?>   <br>
		<b>NRO DOCUMENTO:</b><?php echo($ventaU->dni_ruc)?><br>
		<b>TELÉFONO:</b> <?php echo($ventaU->telefono)?> <br>
		<b>DIRECCIÓN:</b>  <?php echo($ventaU->direccion)?><br>
	</div>	
	<div class="col-sm-6">	
		<b>COMPROBANTE</b> <br>
		<b>TIPO DE COMPROBANTE:</b> <?php echo($ventaU->descripcion)?> <br>
		<b>SERIE:</b><?php echo($ventaU->serie)?> <br>
		<b>CORRELATIVO:</b><?php echo($ventaU->correlativo)?> <br>
		<b>FECHA:</b> <?php echo($ventaU->fechaventa)?> 
	</div>	
</div>
<br>
<div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Importe</th>
				</tr>
			</thead>
			<tbody>
				  <?php  if (!empty($detalleVentaU)):?>
                    <?php  foreach($detalleVentaU as $linea):?>
                   	<tr>
						<td><?php echo $linea->CodigoBarras?></td>
						<td><?php echo $linea->Descripcion?></td>
						<td><?php echo $linea->id_producto?></td>
						<td><?php echo $linea->cantidad?></td>
						<td><?php echo $linea->importe?></td>
					</tr>
				  <?php endforeach; ?>
                  <?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
					<td><?php echo($ventaU->subtotal)?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>IGV:</strong></td>
					<td><?php echo($ventaU->igv)?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Descuento:</strong></td>
					<td><?php echo($ventaU->descuento)?></td>
				</tr>
				<tr>
					<td colspan="4" class="text-right"><strong>Total:</strong></td>
					<td><input type="hidden" id="totalventamodal" value="<?php echo($ventaU->totalventa)?>"><?php echo($ventaU->totalventa)?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>