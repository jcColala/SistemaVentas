function facturarVenta(id){
	 $.ajax({ 
  			   type:'POST',
  			   url: BASE_URL+"/FacturadorController/enviarsunat",
  			   data:{id:id},
  			    success: function(data){
  			    	
  			    }
  				});
}