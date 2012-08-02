<div id="body">

<div id="black_overlay" onclick="document.getElementById('edit_user').style.display='none';document.getElementById('black_overlay').style.display='none';document.getElementById('add_evento').style.display='none';document.getElementById('edit_evento').style.display='none';"></div>
<div id="add_evento">
<h3>Nuevo Evento</h3>
<form method="POST" action="<?php echo $path['url'] ?>">
<input type="hidden" name="sesion" value="agregar_evento"/>
<input type="text" name="titulo" placeholder="Titulo" autocomplete="off" maxlength="30" value="" required /><br>
<input type="text" name="fecha" placeholder="Fecha (dd-mm-yyyy))" maxlength="10" pattern="\d{2}-\d{2}-\d{4}" value="" required /><br>
<textarea name="comentario" placeholder="Comentarios" autocomplete="off" rows="5">
</textarea><br>
<input type="text" name="rama" placeholder="Tag (ej. Matematicas)" autocomplete="off" maxlength="30" required/><br>
<input type="submit" name="submitted" value="Crear Evento">
</form><br>
<p>*Solo serán mostrados los eventos próximos (fecha igual o mayor a la actual)</p>
</div>
<div id="edit_evento">
<h3>Editar Evento</h3>
<form id="edit_form" method="POST" action="<?php echo $path['url'] ?>">
<input type="hidden" name="sesion" value="editar_evento"/>
<input type="hidden" name="id" value=""/>
<input type="text" name="titulo" placeholder="Titulo" autocomplete="off" maxlength="30" value="" required /><br>
<input type="text" name="fecha" placeholder="Fecha (dd-mm-yyyy))" maxlength="10" pattern="\d{2}-\d{2}-\d{4}" value="" required /><br>
<textarea name="comentario" placeholder="Comentarios" autocomplete="off" rows="5">
</textarea><br>
<input type="text" name="rama" placeholder="Tag (ej. Matematicas)" autocomplete="off" maxlength="30" required/><br>
<input type="submit" name="submitted" value="Editar Evento">
</form><br><br>
<h3>Eliminar Evento</h3>
<form id="eli_form" method="POST" action="<?php echo $path['url'] ?>" >
<input type="hidden" name="sesion" value="eliminar_evento"/>
<input type="hidden" name="id" value=""/>
<input type="submit" name="submitted" value="Eliminar Evento"></form>
</div>


<div id="agregar">
<a href="javascript:void(0)" 
	onclick="document.getElementById('black_overlay').style.display='block';document.getElementById('add_evento').style.display='block';" >
<img src="images/Postit_add.png" width="75" height="75" alt="" />
</a>
</div>


<?
	$cont = 0;
	$array = proximos($_SESSION['user_id']);
	if(mysql_affected_rows() != 0) {
	while($row = mysql_fetch_assoc($array)) {
		$dif = difFecha($row['evento_fecha'], date('Y-m-d'));
		if($cont < 3) {
?>
<div class="eventoA" onclick="editar(<? echo "'".$row['evento_id']."'".','."'".$row['evento_fecha']."'".','."'".$row['evento_nombre']."'".','."'".$row['evento_comentario']."'".','."'".$row['evento_rama']."'"; ?>);">
<div class="Atitulo"><p><? echo $row['evento_nombre']; ?></p></div>
<? if($dif > 1) { ?>
<div class="Adias"><p><? echo $dif; ?>
<span><br>Días</span></p>
</div>
<? } elseif($dif == 1) { ?>
<div class="Adias"><p>Mañana</p></div>
<? } elseif($dif == 0) { ?>
<div class="Adias"><p>HOY</p></div> <? } ?>
<div class="rama"><p><? echo $row['evento_rama'] ?></p></div>
<div class="editar"><p><a href="javascript:void(0)" onclick="editar(<? echo "'".$row['evento_id']."'".','."'".$row['evento_fecha']."'".','."'".$row['evento_nombre']."'".','."'".$row['evento_comentario']."'".','."'".$row['evento_rama']."'"; ?>);">+info/editar</a></p></div>
</div>
<?			
		}else{
?>
<div class="eventoB" onclick="editar(<? echo "'".$row['evento_id']."'".','."'".$row['evento_fecha']."'".','."'".$row['evento_nombre']."'".','."'".$row['evento_comentario']."'".','."'".$row['evento_rama']."'"; ?>);">
<div class="Btitulo"><p><? echo $row['evento_nombre']; ?></p></div>
<? if($dif > 1) { ?>
<div class="Bdias"><p><? echo $dif; ?>
<span><br>Días</span></p>
</div>
<? } elseif($dif == 1) { ?>
<div class="Bdias"><p>Mañana</p></div>
<? } elseif($dif == 0) { ?>
<div class="Bdias"><p>HOY</p></div> <? } ?>
<div class="rama"><p><? echo $row['evento_rama'] ?></p></div>
<div class="editar"><p><a href="javascript:void(0)" onclick="editar(<? echo "'".$row['evento_id']."'".','."'".$row['evento_fecha']."'".','."'".$row['evento_nombre']."'".','."'".$row['evento_comentario']."'".','."'".$row['evento_rama']."'"; ?>);">+info/editar</a></p></div>
</div>
<?
		}
		$cont++;
	}
	}else {
?>
<div id="sin_eventos">
<a href="javascript:void(0)" 
	onclick="document.getElementById('black_overlay').style.display='block';document.getElementById('add_evento').style.display='block';" >
<img src="images/Postit_add.png" width="250" height="250" alt="" />
</a>
</div>
<? } ?>
</div> <!-- end div body -->
	
