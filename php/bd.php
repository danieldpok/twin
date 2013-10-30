<?php
//**** CONEXION A LA BD

$bd =  new BD();

class BD	{
	/*var $host="localhost";
	var $user="root";
	var $password="";
	var $database="twinm";*/
	var $user="dakacom1_twinm";
	var $password="301727958";
	var $database="dakacom1_twinm";
	var $conn;
		
	const ABIERTA=1;
	const CERRADA=0;
	
	var $status = CERRADA;
	
	public function open()	{
		$this->conn = mysql_connect($this->host, $this->user, $this->password) or die(mysql_error());
		mysql_select_db($this->database, $this->conn) or die(mysql_error());
	}
	
	public function close()	{
		mysql_close($this->conn);
	}
	
	public function ExecuteNonQuery($sql)	{
		if($this->status==BD::CERRADA)	$this->open();
		$rs  = mysql_query($sql, $this->conn);
		settype($rs, "null");
	}
	
	public function Execute($query)	{
		if($this->status==BD::CERRADA)	$this->open();
		$rs=mysql_query($query, $this->conn) or die("Error en: $query: " . mysql_error());
		
		$registros=array();
		while($reg=mysql_fetch_array($rs))	{
			$registros[]=$reg;
		}
		
		return $registros;
	}
	
	public function ExecuteRS($query)	{
		if($this->status==BD::CERRADA)	$this->open();
		$rs=mysql_query($query, $this->conn);
		return $rs;
	}
	
	////devuelve una fila con todos los campos
	public function ExecuteRecord($tableName, $filter)	{
		$todos = $this->Execute("SELECT * FROM $tableName WHERE $filter");
		return $todos[0];
	}
	
	////devuelve una columna con todos sus registros
	public function ExecuteField($tableName, $field, $filter)	{
		$todos=$this->Execute("SELECT $field FROM $tableName WHERE $filter");
		
		$aux=array();
		foreach($todos as $uno)	{
			$aux[]=$uno[0];
		}
		
		return $aux;
	}
	
	////todos los registros de una tabla
	public function ExecuteTable($tableName, $orden="")	{
		if($orden!="")
			return $this->Execute("SELECT * FROM ".$tableName." ORDER BY ".$orden );
		else
			return $this->Execute("SELECT * FROM ". $tableName);
	}
	
	///trae un solo valor de la base de datos
	public function ExecuteScalar($query)	{
		if($this->status==BD::CERRADA) $this->open();
		
		$rs=mysql_query($query, $this->conn) or die(mysql_error());
		
		$reg =mysql_fetch_array($rs);
		return $reg[0];
	}
	
	///devuelve la cantidad de registros de una tabla
	public function RecordCount($tableName)	{
		return $this->ExecuteScalar("SELECT COUNT(*) FROM ".$tableName);
	}
	
	public function GetLastId($table)	{
		return $this->ExecuteScalar("SELECT id".$table." FROM ".$table." order by id".$table." desc limit 1");
	}
	/////////////////////////////
	/**
*Este Metodo recibe como parametro
*el nombre de la @tabla,
*el arreglo de  @campos,
*el arreglo de @valores.
*que se insertaran en la base de datos
**/
function InsertArray($table,$fields,$values){ 
		$query = "Insert into $table ".$this->ConvineValsInsert($fields,$values);		
		$this->ExecuteNonQuery($query);
		return $this->GetLastId($table);
}
/** Este Metodo recibe como parametro:
*EL nombre de la tabla ->$table
*un arreglo de campos $fields[]
*un arreglo de valores $values[]
*y una condicion si asi lo requiere, si esta viene null 
*Se forma una consulta a la base de datos sin where (condicion)
**/
function UpdateArray($table,$fields,$values,$condition){
	/*if($condition==NULL){
		$query = "update $table set ".$this->ConvineValsUpdate($fields,$values);
	}else{*/
		$query = "update $table set ".$this->ConvineValsUpdate($fields,$values)." where $condition";		
	//}
	$this->ExecuteNonQuery($query);
	
}
	/////////////convine vals
	function ConvineValsInsert($fields,$data){
	$size = count($data);				       
				
		for($i=0;$i<$size;$i++){
			  if($i==$size-1){		
			    $fd = $fd . $fields[$i];
				$val = $val. "'".$data[$i]."'";
			   }else{				 
				$fd = $fd . $fields[$i].",";
				$val = $val. "'".$data[$i]."',";	
			 }		 
		}					 
					
		$arg="($fd) values ($val)";
		return $arg;				
	}
	////////chekar este metodo
	function ConvineValsUpdate($fields,$data){
		$size = count($data);
		for($i=0;$i<$size;$i++){
			if($i==$size-1){
			$arg = $arg . $fields[$i]."='".$data[$i]."'";
			//$val = $val. "'".$data[$i]."'";
			}else{
			$arg = $arg. $fields[$i]."='".$data[$i]."',";
			//$val = $val. "'".$data[$i]."',";
			}
		}
		return $arg;
	}
	function SetExeption($Mensage){
	 $this->EX = $Mensage;
	}
}	
?>
