function makeLinks()	{
	 var opciones =$('#cssmenu a');	
	 opciones.on("click", function()	{
					show(this.id);
					});
	loadingOff();
}

function show(nombre)	{
	loadingOn();
	newForm=true;	
	$.ajax({url: nombre, cache: false,
		   success: function(respuesta)	{
			   $('#mainContent').html(respuesta);
			   loadingOff();
		   }
	});
}