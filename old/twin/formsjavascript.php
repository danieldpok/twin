<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
for($i=0; $i<3; $i++)	{
	?>
<form id="form1" name="form1" method="post" action="">
  <span id="spryselect1">
  <label>
    <select name="tipo" id="tipo" onchange="message(<?php echo $i?>)">
    <option value="uno">uno</option>
    <option value="dos">dos</option>
    </select>
  </label>
  <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
  <span id="spryselect2">
  <label>
    <select name="valores" id="valores">
    </select>
  </label>
  <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
</form>
    <?php
}
?>
<script type="text/javascript">
<!--
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
//-->
</script>

<script type="text/javascript">
//var val1=new array("A", "B", "C");
//var val2=new array("1", "2", "3", "4", "5");

function message(val)	{
	if(document.forms[val].tipo.value=="uno")	{
		//var num_reg = val1;
		//for(var i=0; 
		document.forms[val].valores[1].value="1";
		document.forms[val].valores[1].text="1";
		
	} else if(document.forms[val].tipo.value=="dos")	{
		document.forms[val].valores[1].value="2";
		document.forms[val].valores[1].text="2";
	}
    alert(document.forms[val].tipo.value+" "+val);
}

</script>
</body>
</html>