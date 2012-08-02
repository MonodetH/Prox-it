<div id="login_lightbox">
<h3>Iniciar sesión</h3>
<form method="POST" action="<?php echo $path['url'] ?>"> 
<input type="hidden" name="sesion" value="iniciar"/>
<input type="text" name="login" placeholder="Username" value="" autofocus="autofocus" required /><br>
<input type="password" name="pass" placeholder="Password" value="" required /><br>
<input type="submit" name="submitted" value="Entrar">
<a id="a-reg" href="javascript:void(0)" onclick="document.getElementById('registro').style.display='inline';document.getElementById('a-reg').style.display='none';">Registrar!</a>
</form>
<div id="registro">
<br><hr><br>
<h3>Registro</h3>
<form method="POST" action="<?php echo $path['url'] ?>">
<input type="hidden" name="sesion" value="registrar"/>
<input type="text" name="login" placeholder="Username" maxlength="30" value="" required /><br>
<input type="password" name="pass" placeholder="Password" autocomplete="off" value="" required /><br>
<input type="password" name="pass2" placeholder="Re-Password" autocomplete="off" value="" required /><br>
<input type="submit" name="submitted" value="Registrar">
</form>
</div> <!-- end registro -->
</div><!-- login_lightbox -->