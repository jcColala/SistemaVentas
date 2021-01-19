<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="<?php echo $baseurl ?>/public/mycss/styleComprobantes.css">
</head>
<body>

<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="<?php echo $baseurl ?>/public/img/logo.png">
					<h5><strong>De: HUARCAYA HUALLPARUCA CESAR<strong></h5>
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<H5><strong>SERVICIO TÉCNICO</strong></H5>
					<P>Laptops,Pc's, Impresoras, Tablets, Smartphones</P>
					<H5>VENTA</H5>
					<P>Equipos,portafolios,Suministros y Accesorios de computo</P>
					<h5>SOLUCIONES INFORMÁTICAS</h5>
					<P>Inst. de software, recuperación de datos e información</P>
					<h5>DISEÑO</h5>
					<P>Páginas Web y Programación</P>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3"><?php echo($ventaU->descripcion)?> </span>
					<p>Correlativo: <strong><?php echo($ventaU->correlativo)?></strong></p>
					<p>Serie: <strong><?php echo($ventaU->serie)?></strong></p>
					<p>Fecha: <?php echo($ventaU->fechafacturacion)?></p>
					<p>Hora:<?php echo($ventaU->horafacturacion)?></p>
					
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round2">
					<span class="info_direccion">Av Giráldez N° 281 Int. 05 - Huancayo- Huancayo -Junin 
				(2do. piso -Galerías Paris)- Tel.(064)589880 - Cel.993081081</span>
				</div>
			</td>	
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Dni/Ruc:</label><p><?php echo($ventaU->dni_ruc)?></p></td>
							<td><label>Teléfono:</label> <p><?php echo($ventaU->telefono)?></p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p><?php echo($ventaU->nombre)?> </p></td>
							<td><label>Dirección:</label> <p> <?php echo($ventaU->direccion)?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				  <?php  if (!empty($detalleVentaU)):?>
                    <?php  foreach($detalleVentaU as $linea):?>
                    	<tr>
							<td class="textcenter"><?php echo $linea->cantidad?></td>
							<td><?php echo $linea->Descripcion?></td>
							<td class="textright"><?php echo $linea->importe?></td>
							<td class="textright"><?php echo $linea->importe?></td>
						</tr>
                      <?php endforeach; ?>
                  <?php endif; ?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL .</span></td>
					<td class="textright"><span><?php echo($ventaU->subtotal)?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (18%)</span></td>
					<td class="textright"><span><?php echo($ventaU->igv)?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL .</span></td>
					<td class="textright"><span><?php echo($ventaU->totalventa)?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<img src="<?php echo($baseurl.'/temp/'.$filename)?>" alt="">
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>