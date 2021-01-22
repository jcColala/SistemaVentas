<?php namespace App\Controllers;
use App\Models\VentaModel;
use App\Models\CajaModel;
require_once("app/ThirdParty/vendor/autoload.php");
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use  Greenter\XMLSecLibs\Sunat\SignedXml;
class FacturadorController extends BaseController
{ 
	public function index(){
		$request=\Config\Services::request();
		$VentaModel=new VentaModel;
		$CajaModel=new CajaModel;
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$data= array('ventas' =>$VentaModel->GetVenta(),'caja'=>$CajaModel->getCaja());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/listadofacturacion.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	
	public function enviarsunat(){
		$request=\Config\Services::request();
		$idVenta=$request->getPostGet("id");	
    	$VentaModel=new VentaModel;
    	$data= array('ventaU' =>$VentaModel->GetVentaU($idVenta),
					 'detalleVentaU' =>$VentaModel->getdetalleVenta($idVenta),
					 'baseurl'=>base_url()
					 );
    	$doc = new \DOMDocument('1.0','iso-8859-1');
    	$doc->xmlStandalone = false;
		$doc->formatOutput = true;
		$raiz = $doc->createElement("Invoice");
		$raiz = $doc->appendChild($raiz);
		$raiz->setAttribute('xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2');
		$raiz->setAttribute('xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
		$raiz->setAttribute('xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
		$raiz->setAttribute('xmlns:ccts', 'urn:un:unece:uncefact:documentation:2');
		$raiz->setAttribute('xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');
		$raiz->setAttribute('xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
		$raiz->setAttribute('xmlns:qdt', 'urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2');
		$raiz->setAttribute('xmlns:udt', 'urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2');
		$raiz->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');

		$UBLExtension = $doc->createElement("ext:UBLExtensions");
		$UBLExtension = $raiz->appendChild($UBLExtension);

		$ext = $doc->createElement('ext:UBLExtension');
		$ext = $UBLExtension->appendChild($ext);

		$contents = $doc->createElement('ext:ExtensionContent');
		$contents = $ext->appendChild($contents);

		$signatureCabecera = $doc->createElement('ds:Signature');
		$signatureCabecera = $contents->appendChild($signatureCabecera);
		$signatureCabecera->setAttribute('Id', 'arribaperu');

		$SignedInfoCabe = $doc->createElement('ds:SignedInfo');
		$SignedInfoCabe = $signatureCabecera->appendChild($SignedInfoCabe);

		$SigCabeceraInfo = $doc->createElement('ds:CanonicalizationMethod');
		$SigCabeceraInfo = $SignedInfoCabe->appendChild($SigCabeceraInfo);

		$SigCabeceraInfo->setAttribute('Algorithm', 'http://www.w3.org/TR/2001/REC-xml-c14n20010315');

		$SigSignatureInfo = $doc->createElement('ds:SignatureMethod');
		$SigSignatureInfo = $SignedInfoCabe->appendChild($SigSignatureInfo);
		$SigSignatureInfo->setAttribute('Algorithm', 'http://www.w3.org/2000/09/xmldsig#rsa-sha1');

		$SigReferenceCabe = $doc->createElement('ds:Reference');
		$SigReferenceCabe = $SignedInfoCabe->appendChild($SigReferenceCabe);
		$SigReferenceCabe->setAttribute('URI', '');

		$SigTransformsCabe = $doc->createElement('ds:Transforms');
		$SigTransformsCabe = $SigReferenceCabe->appendChild($SigTransformsCabe);

		$TransformsInfoCabe = $doc->createElement('ds:Transform');
		$TransformsInfoCabe = $SigTransformsCabe->appendChild($TransformsInfoCabe);
		$TransformsInfoCabe->setAttribute('Algorithm', 'http://www.w3.org/2000/09/xmldsig#enveloped-signature');

		$DigestMethodCabe = $doc->createElement('ds:DigestMethod');
		$DigestMethodCabe = $SigReferenceCabe->appendChild($DigestMethodCabe);
		$DigestMethodCabe->setAttribute('Algorithm', 'http://www.w3.org/2001/04/xmlenc#sha256');

		$DigestValueCabe = $doc->createElement('ds:DigestValue',' ');
		$DigestValueCabe = $SigReferenceCabe->appendChild($DigestValueCabe);

		$SignatureValuecabe = $doc->createElement('ds:SignatureValue',' ');
		$SignatureValuecabe = $signatureCabecera->appendChild($SignatureValuecabe);
//llave certificado
		$KeyInfocabe = $doc->createElement('ds:KeyInfo');
		$KeyInfocabe = $signatureCabecera->appendChild($KeyInfocabe);

		$keyX509Data = $doc->createElement('ds:X509Data');
		$keyX509Data = $KeyInfocabe->appendChild($keyX509Data);
		$keyXName = $doc->createElement('ds:X509SubjectName','djjdjdjddj');
		$keyXName = $keyX509Data->appendChild($keyXName);

		$Certificatexml = $doc->createElement('ds:X509Certificate','certificado');
		$Certificatexml = $keyX509Data->appendChild($Certificatexml);

		$doc->save($_SERVER['DOCUMENT_ROOT'] . "/SistemaVentas/public/archivos/xml/usuarios.xml");
	   chmod($_SERVER['DOCUMENT_ROOT'] . '/SistemaVentas/public/archivos/xml/usuarios.xml', 0777); 
	   $this->firmarxml();	
	}
	protected function firmarxml(){
	$baseurl=base_url();
	$xmlPath = $_SERVER['DOCUMENT_ROOT']."/SistemaVentas/public/archivos/xml/usuarios.xml";
	$certPath =$_SERVER['DOCUMENT_ROOT'].'/SistemaVentas/public/cerificado/LLAMA-PE-CERTIFICADO-DEMO-10719804905.pem';  	

	
	 $signer = new SignedXml();
	 $signer->setCertificateFromFile($certPath);
	 $xmlSigned = $signer->signFromFile($xmlPath);
	 file_put_contents($xmlPath, $xmlSigned);
	}
	
}
