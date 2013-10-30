function cargarFormEH()	{
	loadingOn();
	var idops =$("#idop").val();
	var condition = "idop="+idops+"";
	$.ajax({url: "php/loadForm.php",
		data: {tabla:"operaciones" , condition:condition},
		type: "POST",
		cache: false,
			   success: function(respuesta)	{
				   eval(respuesta);				   
				   $("#factspdf").attr({href:"reports/docs/factspdf.php?id="+idops});
				   $("#factshtml").attr({href:"reports/docs/factsanterior.php?id="+idops});
			   }
		}).done(cargarTablaHechos());
}
function cargarTablaHechos()	{
	var idop =$("#idop").val();
	$.ajax({url: "php/factsTableForms.php",
		data: {idop:idop},
		type: "POST",
		cache: false,
			   success: function(respuesta)	{
				   $("#tablaHechos").html(respuesta);		   
			   }
		}).done(loadingOff());
}
function addFact(){
	var idop =$("#idop").val();
	if(idop!=undefined && idop!="")	{
		//Agregar a la BD
	    var form = $("#adFact").parents('form:first');
		var data = form.serialize()+"&idop="+idop;
		autoSave(data);
		//Refrescar tabla
		cargarTablaHechos();
		alert("Registro agregado");
		document.getElementById("frm1").reset();
	}	else{
		alert("Primero debe cargar un ID");
	}
	
}
///////
function cargarFormCT()	{
	loadingOn();
	var idops =$("#idop").val();
	var condition = "idop="+idops+"";
	$.ajax({url: "php/loadForm.php",
		data: {tabla:"operaciones" , condition:condition},
		type: "POST",
		cache: false,
			   success: function(respuesta)	{
				   eval(respuesta);				   
				   /*$("#factspdf").attr({href:"reports/docs/factspdf.php?id="+idops});
				   $("#factshtml").attr({href:"reports/docs/factsanterior.php?id="+idops});*/
			   }
		}).done(function(){
			calcular();
			loadingOff();
			cargarTablaComputo();
			});
}
function cargarTablaComputo()	{
	var idop =$("#idop").val();
	$.ajax({url: "php/compTableForms.php",
		data: {idop:idop},
		type: "POST",
		cache: false,
			   success: function(respuesta)	{
				   $("#tablaComputo").html(respuesta);		   
			   }
		}).done(loadingOff());
}
function calcular()	{

		var dxmin=parseFloat($("#dischperday").val().replace(",",""))/1440;
		var tmin=parseFloat($("#quantity").val().replace(",",""))/dxmin;
	
		var minTot = parseFloat($("#quantity").val().replace(",","")) / (parseFloat($("#dischperday").val().replace(",",""))/ 1440);

        var MIN = parseInt(minTot);
        var HORAS, DIAS, BUF;

        if (MIN % 60 != 0) {
            BUF = MIN;
            MIN = MIN % 60;
            HORAS = (BUF - MIN) / 60;
        } else {
            HORAS = MIN / 60;
            MIN = 0;
        }

        if (HORAS % 24 != 0) {
            BUF = HORAS;
            HORAS = HORAS % 24;
            DIAS = (BUF - HORAS) / 24;
        } else {
            DIAS = HORAS / 24;
            HORAS = 0;
        }

        var min = parseInt(MIN), dias = parseInt(DIAS), horas = parseInt(HORAS);

        var fVal;
        fVal = dias+"D:"+horas+"H:"+min+"M";
		$("#timeallowed").val(fVal);
  }
   