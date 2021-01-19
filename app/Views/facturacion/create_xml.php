<?php 
$doc = new DOMDocument('1.0');

	$doc->formatOutput = true;

	$raiz = $doc->createElement("USUARIOS");
	$raiz = $doc->appendChild($raiz);

	$usuario = $doc->createElement("USUARIO");
	$usuario = $raiz->appendChild($usuario);

	$id = $doc->createElement("ID");
	$id = $usuario->appendChild($id);
	$textId = $doc->createTextNode(1);
	$textId = $id->appendChild($textId);

	$nombre = $doc->createElement("NOMBRE");
	$nombre = $usuario->appendChild($nombre);
	$textNombre = $doc->createTextNode("Sergio");
	$textNombre = $nombre->appendChild($textNombre);

	$telefono = $doc->createElement("TELEFONO");
	$telefono = $usuario->appendChild($telefono);
	$textTelefono = $doc->createTextNode("4324245432");
	$textTelefono = $telefono->appendChild($textTelefono);

	$email = $doc->createElement("EMAIL");
	$email = $usuario->appendChild($email);
	$textEmail = $doc->createTextNode("sergio@hola.es");
	$textEmail = $email->appendChild($textEmail);

	$doc->save($_SERVER['DOCUMENT_ROOT'] . "/SistemaVentas/Archivos/xml/usuarios.xml");
	chmod($_SERVER['DOCUMENT_ROOT'] . '/SistemaVentas/Archivos/xml/usuarios.xml', 0777);

 ?>