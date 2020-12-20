function reFresh() {
   location.reload();
}
function seleccionar(id1,id2,cantidad){
	 for (var i = 1; i <=cantidad; i++) {
	 	var a0 = document.getElementById("div_"+i+"_modal");
	 	a0.style.cssText= "display:none;";

	 	var a1 = document.getElementById("span_selec_"+i);
	 	a1.style.cssText= "border: 1px solid #fff;border-bottom: 1px solid #e0e0e0;";
	 }
	var a2 = document.getElementById(id1);
	a2.style.cssText= "display:block;";

	var a3 = document.getElementById(id2);
	a3.style.cssText= "border:1px solid #e0e0e0; border-bottom: 1px solid #fff; z-index: 1;";

}