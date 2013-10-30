function getTable(tabla, campos, condicion, editable)	{
	$.post("php/gettable.php", "tabla="+tabla+"&campos="+campos+"&condicion="+condicion+"&editable="+editable, function(result){		
		$("tbody").html(result);
		$("tbody tr").hide();
		$(".bloque1").show();		
	});
}

$(document).on('click', '.tnext', function(){    ////PAGINACION DE LAS TABLAS siguiente
    var bloque=$(this).attr('ref');
    $("tbody tr").hide();    
	$("."+bloque).show();
});

$(document).on('click', '.tback', function(){    ////PAGINACION DE LAS TABLAS anterior
    var bloque=$(this).attr('ref');
    $("tbody tr").hide();    
	$("."+bloque).show();
});
$(document).on('click', '.npagina', function(){    ////PAGINACION DE LAS TABLAS anterior
    var bloque=$(this).attr('ref');
    $("tbody tr").hide();    
	$("."+bloque).show();
});

$(document).on('click', '.tedit', function(){    ////PAGINACION DE LAS TABLAS anterior
    var id=$(this).attr('id');
    loadForm($("#form").val(), id);
});

$(document).on('click', '.tdelete', function(){    ////PAGINACION DE LAS TABLAS anterior
    var id=$(this).attr('id').split(",")[0];
    var table=$(this).attr('id').split(",")[1];
    deleteReg(id, table);
      
});
$(document).on('click', '.newf', function(){
	show($("#form").val());
});

