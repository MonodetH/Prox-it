<?php	
	require getcwd().'/config.php';
	require $path['files'].'funciones.php';
	session_start();	
	
	date_default_timezone_set("Chile/Continental");
	
	if(isset($_POST['sesion'])) {
		if($_POST['sesion']=='agregar_evento') {
			$_POST['fecha'] = arreglarFecha($_POST['fecha']);
			$_POST['titulo'] = htmlspecialchars(trim($_POST['titulo']));
			$_POST['comentario'] = htmlspecialchars(trim($_POST['comentario']));
			$_POST['rama'] = htmlspecialchars(trim($_POST['rama']));
			
			$flag = agregarEvento($_SESSION['user_id'],$_POST['fecha'],$_POST['titulo'],$_POST['comentario'],'none',$_POST['rama']);
			if(!$flag){$_SESSION['mensaje']='Error al crear nuevo evento';}
			unset($_POST['sesion']);
			unset($_POST['fecha']);
			unset($_POST['titulo']);
			unset($_POST['comentario']);
			unset($_POST['rama']);
		}elseif($_POST['sesion']=='editar_evento') {
			$_POST['fecha'] = arreglarFecha($_POST['fecha']);
			$_POST['titulo'] = htmlspecialchars(trim($_POST['titulo']));
			$_POST['comentario'] = htmlspecialchars(trim($_POST['comentario']));
			$_POST['rama'] = htmlspecialchars(trim($_POST['rama']));
			
			$flag = editarEvento($_POST['id'],$_SESSION['user_id'],$_POST['fecha'],$_POST['titulo'],$_POST['comentario'],'none',$_POST['rama']);
			if(!$flag){$_SESSION['mensaje']='Error al editar evento';}
			unset($_POST['sesion']);
			unset($_POST['fecha']);
			unset($_POST['titulo']);
			unset($_POST['comentario']);
			unset($_POST['rama']);
		}elseif($_POST['sesion']=='eliminar_evento') {
			$flag = eliminarEvento($_POST['id']);
			if(!$flag){$_SESSION['mensaje']='Error al eliminar evento';}
		}else{
			if($_POST['sesion']=='editar_usuario'){
				$login = htmlspecialchars(trim($_POST['login']));
				$pass0 = trim($_POST['pass0']);
				$pass1 = trim($_POST['pass']);
				$pass2 = trim($_POST['pass2']);
				
				$flag=editarUser($_SESSION['user_id'],$login,$pass0,$pass1,$pass2);
				if($flag) {
					$_POST['sesion'] = 'iniciar';
					if($_POST['pass']==''){
						$_POST['pass']=$_POST['pass0'];
						$_SESSION['mensaje']='Nombre de usuario modificado';
					}
					else{$_SESSION['mensaje']='Datos modificados exitosamente';}
				}
				else {$_SESSION['mensaje']='El nombre de usuario ya existe o contraseñas erroneas';}
			}
			if($_POST['sesion']=='registrar') {
				$login = htmlspecialchars(trim($_POST['login']));
				$pass1 = trim($_POST['pass']);
				$pass2 = trim($_POST['pass2']);
			
				$flag=registro($login,$pass1,$pass2);
			
				if($flag) {
					$_POST['sesion'] = 'iniciar';
					$_SESSION['mensaje']='Registro exitoso';
				}
				else {$_SESSION['mensaje']='Error al registrar';}
			}
			if($_POST['sesion']=='iniciar') {
				$flag = iniciarSesion($_POST['login'],$_POST['pass']);
				if(!$flag){$_SESSION['mensaje']='El usuario no existe o contraseña erronea';}
			}
			elseif($_POST['sesion']=='cerrar' && isset($_SESSION['user'])) {
				session_unset();		
				session_destroy();
			}
			unset($_POST['sesion']);
		}
	}
	
	$url_param = get_url();
	
	require $path['files'].'header.php';
	if(isset($_SESSION['user'])) {
		if(count($url_param)>1) {require $path['files'].'b_404.php';}
		else {require $path['files'].'b_principal.php';}
	}
	else {require $path['files'].'b_login.php';}
	
	
	if(isset($_SESSION['mensaje'])) {
		echo "<script language='JavaScript' type='text/javascript'>
				alert('";
		echo $_SESSION['mensaje'];
		echo "');
				</script>";
		unset($_SESSION['mensaje']);
	}
	
	require $path['files'].'footer.php';
?>
