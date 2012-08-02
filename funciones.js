$(document).ready(
	function()
	{
		$(".tab_content").hide();
		$("ul.tabs li:first").addClass("active").show();
		$(".tab_content:first").show();
	
		$("ul.tabs li").click(
			function()
	      {
				$("ul.tabs li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide();
		
				var activeTab = $(this).find("a").attr("href");
				$(activeTab).fadeIn();
				return false;
			}
		);
		
	}
);
function editar(id,fecha,titulo,comentario,rama){
	var ano = fecha.substring(0,4);
	var mes = fecha.substring(5,7);
	var dia = fecha.substring(8);
	
	fecha = dia.concat('-',mes,'-',ano);
	var x = document.getElementById("edit_form");
	x.elements['id'].value = id;
	x.elements['fecha'].value = fecha;
	x.elements['titulo'].value = titulo;
	x.elements['comentario'].value = comentario;
	x.elements['rama'].value = rama;
	var x = document.getElementById("eli_form");
	x.elements['id'].value = id;
	
	document.getElementById('black_overlay').style.display='block';
	document.getElementById('edit_evento').style.display='block';
}
function editar_usuario(id,user){
	var x = document.getElementById("user_form");
	x.elements['id'].value = id;
	x.elements['login'].value = user;
	
	document.getElementById('black_overlay').style.display='block';
	document.getElementById('edit_user').style.display='block';
}
