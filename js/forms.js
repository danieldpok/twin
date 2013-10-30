$(document).on('click', '#save', function(){    ////GUARDA LOS DATOS CUANDO SE DA CLICK EN EL BOTON GUARDAR
    var buf = true;
    $(".required").each(function(){
        if($(this).val()=="")   {
            $(this).css('background-color', 'lightyellow');
            buf=false;
        }
    });
    if(buf)
        saveForm();        
    else
        alert("Por favor llene todos los campos requeridos.");
});

$(document).on('click', '#delete', function(){	deleteForm()	});

$(document).on('click', '#new', function(){	cleanForm()	});

$(document).on('click', '.formLink', function(){	show(this.id);	});

//////////////////////////////////////////////////////
//////////////////////EVENTOS PARA LAS CLASES DE LOS COMPONENTES
//////////////////////////////////////////////////////
function setClassEvents() {
	$('input[type="button"]').button();
    /////CAMBIA EL COLOR DE UN CAMPO REQUERIDO AL PERDER EL FOCO
    $(".required").on("blur", function()	{
            if($(this).val()=="")
                    $(this).css('background-color', 'lightyellow');
            else
                    $(this).css('background-color', '#FFFFFF');
    });    
    /////CAMBIA EL COLOR DE UN CAMPO REQUERIDO AL PERDER EL FOCO
    $(".mail").on("blur", function()	{
            var arg=$(this).val();            
            if($(this).val()=="" || !/@/.test(arg) || !/\./.test(arg))
                    $(this).css('background-color', 'lightyellow');
            else
                    $(this).css('background-color', '#FFFFFF');
    });
    /////CLASE QUE SOLO PERMITE CAPTURA DE NUMEROS
    $(".number").on("keydown", function(event){
                if(!event.altKey && ((!event.shiftKey && (event.keyCode >= 48 && event.keyCode <= 57)) || event.keyCode==8 || event.keyCode==39 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46 || (event.keyCode >= 96 &&  event.keyCode <= 105) || event.keyCode==110 || event.keyCode==190)) {
            return true;
        }	else	{
                return false;
        }
    });
    /////CLASE QUE SOLO PERMITE CAPTURA DE LETRAS
    $(".letters").on("keydown", function(event){
        if((event.keyCode > 48 && event.keyCode < 57) || (event.keyCode > 96 &&  event.keyCode < 105) || event.keyCode==39)
            return false;
    });
    /////CLASE QUE SOLO PERMITE CAPTURA DE LETRAS Y NUMEROS
    $(".lettersNumb").on("keydown", function(event){
            if( event.keyCode==32 || event.keyCode==8 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46
             || (!event.shiftKey && (event.keyCode >= 48 && event.keyCode <= 57))
             || (event.keyCode >= 65 && event.keyCode <= 90)
             || (event.keyCode >= 96 && event.keyCode <= 105)
             || (event.keyCode >= 96 && event.keyCode <= 105) )
            return true;
        else
            return false;
    });
    
    /////CLASE QUE SOLO PERMITE FORMATO DE  DINERO
    $(".money").on("keydown", function(event){    
        if((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode==8 || event.keyCode==39 || event.keyCode==37 || event.keyCode==39 || event.keyCode==46 || (event.keyCode >= 96 &&  event.keyCode <= 105) || event.keyCode==110 || event.keyCode==190) {
            return true;
        }	else	{
                return false;
        }
    });
    $(".money").on("blur", function(event){
        $(this).css('text-align','right');
        $(this).formatCurrency();
    });
    /////CLASE QUE SOLO PERMITE FORMATO DE FECHAS
       $(".date").mask("9999-99-99");
       $(".date").datepicker({ dateFormat: 'yy-mm-dd',
                  changeMonth: true,
                  changeYear: true });
    /////CLASE QUE SOLO PERMITE FORMATO DE FECHAS Y HORAS
        $(".datetime").mask("9999-99-99 99:99");
    /////CLASE QUE SOLO PERMITE FORMATO DE HORAS
        $(".time").mask("99:99");     
        
}


////////////////////FUNCIONES BD

function loadForm(urlForm, id)	{
	
	loadingOn();
	$.ajax({url: urlForm, cache: false,
		   success: function(respuesta)	{
			   $('#mainContent').html(respuesta);
			   $('#id').val(id);			   
		   }
	}).done(function(){
			$.ajax({url: "php/loadForm.php", data: {tabla:$("#table").val() , id:$("#id").val()} ,type: "POST", cache: false,
				   success: function(respuesta)	{
					   eval(respuesta);			   
				   }
			}).done(loadingOff());
		});	
}


function setValue(component, value) {
        if(value!='null')   {
            var objeto = $('#'+component);
            if(objeto.attr('type')=='text' || objeto.attr('type')=='password')	{  
            	var clase=objeto.attr('class');
            	if(clase!=undefined && (clase.indexOf("datetime") != -1 || clase.indexOf("date") != -1)){
            		if(value=="0000-00-00 00:00:00")
            			value="";            		
            	}
 				objeto.val(value);
            }                                
            //else if(objeto.attr('type')=='textarea')
            else if(objeto.is('textarea')==true)
                    objeto.html(value);
            else if(objeto.is('select') === true)
                    $("#"+component+" > option[value='"+value+"']").attr({selected: 'selected' });                    
            else if(objeto.attr('type')=='hidden')  {
                if($(this).attr('id')!='table' && $(this).attr('id')!='formtype' && $(this).attr('id')!='tableparent')
                        objeto.val(value);
            }   else if(objeto.attr('type')=='checkbox')   {
                if(value=='on') {
                    $('#'+component).attr("checked","checked");
                }
            }
        }                    
}

function saveForm()	{
	loadingOn();
	var data = $('form').serialize();   /// modificar el padre form of this
	$.ajax({url: "php/saveForm.php", data: data, type: "POST", cache: false,
		   success: function(respuesta)	{
			   $("#id").val(respuesta.replace(/ /g, '').replace(/\n/g, ''));	   
		   }
	}).done(loadingOff());
}

function autoSave(data)	{
	$.ajax({url: "php/saveForm.php", data: data, type: "POST", cache: false,
		   success: function(respuesta)	{	   
		   }
	});
}

function deleteForm()	{
	if(confirm('\u00BFEsta seguro que desea eliminar el registro?'))	{
		loadingOn();
		
		var data = $('form').serialize();   /// modificar el padre form of this
		$.ajax({url: "php/deleteForm.php", data: data, type: "POST", cache: false,
			   success: function(respuesta)	{
				   	cleanForm();  
			   }
		}).done(loadingOff());
	}
}

function deleteReg(id, table)	{
	if(confirm('\u00BFEsta seguro que desea eliminar el registro?'))	{
		
		loadingOn();
		
		$.ajax({url: "php/deleteForm.php", data: {id: id, table:table}, type: "POST", cache: false,
			   success: function(respuesta)	{
				   	$("#"+id+","+table).closest('tr').remove();
			   }
		}).done( loadingOff());
	}
}


function cleanForm(){
    $(':input').each(function(){        
            var objeto = $(this);
            if(objeto.attr('type')=='text')
                    objeto.val('');
            else if(objeto.attr('type')=='password')
                    objeto.val('');
            else if(objeto.attr('type')=='textarea')
                    objeto.html('');
            else if(objeto.is('select') === true)
                    $(this).children('option').first().attr({selected: 'selected' });
            else if(objeto.attr('type')=='hidden')  {
                if($(this).attr('id')!='table')
                        objeto.val('');
                    }
    });
}
function getOptionSelect(componente, tabla, valor, texto, condicion){
	loadingOn();
		
		$.ajax({url: "php/getSelectOptions.php",
			data: {tabla: tabla, condicion:condicion, valor:valor, texto:texto},
			 type: "POST", cache: false,
			   success: function(respuesta)	{
				   	$(componente).html(respuesta);
			   }
		}).done( loadingOff());
}
