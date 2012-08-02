<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Prox-it Calendario</title>
<link rel="STYLESHEET" type="text/css" href="<?php echo $path['web'].'estilos.css' ?>"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $path['web'].'funciones.js' ?>" type="text/javascript" ></script>
</head>
<body>
<div id="edit_user">
<h3>Editar Usuario</h3>
<form id="user_form" method="POST" action="<?php echo $path['url'] ?>" >
<input type="hidden" name="sesion" value="editar_usuario"/>
<input type="hidden" name="id" value=""/>
<input type="text" name="login" placeholder="Username" maxlength="30" value="" required /><br>
<input type="password" name="pass0" placeholder="Password Actual" autocomplete="off" value="" required /><br>
<input type="password" name="pass" placeholder="Nueva Password (opcional)" autocomplete="off" value=""  /><br>
<input type="password" name="pass2" placeholder="Repita Nueva Password" autocomplete="off" value=""  /><br>
<input type="submit" name="submitted" value="Editar Datos"></form>
<br><p>*Usar el cambio de username y/o contraseña con precaución</p>
</div>
<header>
<div id="head_bar">
<div id="logo_head">
<a href="<?php echo $path['url'] ?>" ><img src="<?php echo $path['images'].'logo.png' ?>" alt="Prox-it Calendario" ></a>
</div><!-- end logo_head -->
<?php if (isset($_SESSION['user'])) { ?>

<div id="login_header">
<?php echo "Hola "; ?>
<a href="javascript:void(0)" onclick="editar_usuario(<? echo "'".$_SESSION['user_id']."','".$_SESSION['user']."'"; ?>)"><? echo $_SESSION['user']; ?></a>
<form method="POST" action="<?php echo $path['url'] ?>" style="display: inline;">
<input type="hidden" name="sesion" value="cerrar"/>
<input type="submit" name="submitted" value="Salir"></form>
</div><!-- end login_header -->
<div id="nav">
<h2><? echo date('d-m-Y'); ?></h2>
</div><!-- end nav -->
<?php } ?>
</div><!-- end head_bar -->
</header>
