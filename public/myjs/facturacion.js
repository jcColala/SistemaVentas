function facturarVenta(id){
	 $.ajax({ 
  			   type:'POST',
  			   url: "FacturadorController/enviarsunat",
  			   data:{id:id},
  			    success: function(data){
  			    	
  			    }
  				});
}