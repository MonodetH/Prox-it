<?php
	function urls_amigable($url) {

		// Tranformamos todo a minusculas
		$url = strtolower($url);

		//Rememplazamos caracteres especiales latinos
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace ($find, $repl, $url);
		
		// Añadimos los guiones
		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);

		// Eliminamos y Reemplazamos demás caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);

		return $url;
	}
	
	function get_url() {
		$parametros = array();
		$url = parse_url($_SERVER['REQUEST_URI']);
		foreach(explode("/", $url['path']) as $p){
			if ($p!='') {$parametros[] = $p;}
		}
		return $parametros;
	}
	
	function iniciarSesion($user,$pass) {
		require './config.php';
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);
		
		$user=htmlspecialchars(trim($user));
		$pass=sha1(md5(trim($pass)));
		
		$query = sprintf("SELECT * FROM users WHERE user_name='%s' AND user_pass='%s' LIMIT 1",
		mysql_real_escape_string($user),mysql_real_escape_string($pass));
		
		$result = mysql_query($query);
		if(mysql_num_rows($result)==1) {			
			$array = mysql_fetch_array($result);
			
			$_SESSION['user'] = $array['user_name'];
			$_SESSION['user_id'] = $array['user_id'];

			return TRUE;
		}
		else {return FALSE;}
	}
	
	function registro($user,$pass1,$pass2) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);

		$query = sprintf("SELECT * FROM users WHERE user_name='%s' LIMIT 1",mysql_real_escape_string($user));
		$result = mysql_query($query);
		
		if(mysql_num_rows($result) == 1){return false;} 
		else {
			mysql_free_result($result);
			
			if($pass1!=$pass2) {return false;}
			
			$pass1=sha1(md5($pass1));
			
			$query  =  sprintf("INSERT INTO users (user_name, user_pass) 
			VALUES ('%s','%s')",
			mysql_real_escape_string($user), mysql_real_escape_string($pass1));
			
			$result = mysql_query($query);
 
			if(mysql_affected_rows()){return true;} 
			else {return false;} 
		}	
	}
	
	function editarUser($id,$user,$pass0,$pass1,$pass2) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);
		
		$pass0=sha1(md5($pass0));
		$query = sprintf("SELECT * FROM users WHERE user_id='%s' AND user_pass='%s'  LIMIT 1",$id,mysql_real_escape_string($pass0));
		$result = mysql_query($query);
		
		if(mysql_num_rows($result) != 1){return false;} 
		else {
			mysql_free_result($result);
			
			if($pass1!=$pass2) {return false;}
			if($pass1==''){$pass1=$pass0;}
			else{$pass1=sha1(md5($pass1));}
			
			$query  =  sprintf("UPDATE users SET user_name='%s', user_pass='%s' WHERE user_id='%s'",
			mysql_real_escape_string($user), mysql_real_escape_string($pass1),$id);
			
			$result = mysql_query($query);
 
			if(mysql_affected_rows()){return true;} 
			else {return false;} 
		}	
	}		

	function agregarEvento($user, $fecha, $nombre, $comentario, $tipo, $rama) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);
		
		$query  =  sprintf("INSERT INTO evento (user_id, evento_fecha, evento_nombre, evento_comentario, evento_tipo, evento_rama) 
		VALUES ('%s','%s','%s','%s','%s','%s')",
		mysql_real_escape_string($user), mysql_real_escape_string($fecha),
		mysql_real_escape_string($nombre), mysql_real_escape_string($comentario),
		mysql_real_escape_string($tipo), mysql_real_escape_string($rama));
		
		$result = mysql_query($query);

		if(mysql_affected_rows()){return true;} 
		else {return false;} 
	}
	
	function editarEvento($id,$user, $fecha, $nombre, $comentario, $tipo, $rama) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);
		
		$query  =  sprintf("UPDATE evento SET user_id='%s', evento_fecha='%s', evento_nombre='%s', evento_comentario='%s', evento_tipo='%s', evento_rama='%s' 
		WHERE evento_id='%s' ",
		mysql_real_escape_string($user), mysql_real_escape_string($fecha),
		mysql_real_escape_string($nombre), mysql_real_escape_string($comentario),
		mysql_real_escape_string($tipo), mysql_real_escape_string($rama),$id);
		
		$result = mysql_query($query);

		if(mysql_affected_rows()){return true;} 
		else {return false;} 
	}
	
	function eliminarEvento($id) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);
		
		$query  =  sprintf("DELETE FROM evento WHERE evento_id=%s", $id);
		
		$result = mysql_query($query);

		if(mysql_affected_rows()){return true;} 
		else {return false;} 
	}
	
	function proximos($id) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);

		$query = sprintf("SELECT * FROM evento WHERE user_id='%s' AND evento_fecha >= '%s' ORDER BY evento_fecha ASC",$id, date('Y-m-d') );
		$result = mysql_query($query);
		
		return $result;
	}
	function difFecha($f1,$f2) {
		require './config.php';		
		
		$conexion = mysql_connect($db['server'],$db['user'],$db['pass']);
		mysql_select_db($db['db'],$conexion);

		$query = sprintf("SELECT DATEDIFF('%s','%s');",$f1,$f2);
		$result = mysql_query($query);
		$ret = mysql_fetch_row($result);		
		
		return $ret[0];
	}
	function arreglarFecha($f1) {
		$dia = substr($f1, 0, 2);
		$mes = substr($f1, 3, 2);
		$ano = substr($f1, 6, 4);
		return $ano.'-'.$mes.'-'.$dia;
	}
?>
