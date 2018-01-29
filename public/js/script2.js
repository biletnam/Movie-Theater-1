$(document).ready(function(){
	Carga();
});

function Carga(){
	var tablaDatos = $("#datos");
	var route = "http://localhost:8000/genero";

	$("#datos").empty();
	$.get(route, function(res){
		$(res).each(function(key,value){
			tablaDatos.append("<tr><td>"+value.gender+"</td><td><button value="+value.id+" OnClick='Mostrar(this);' class='btn btn-primary' data-toggle='modal' data-target='#myModal'>Editar</button><button class='btn btn-danger' value="+value.id+" OnClick='Eliminar(this);'>Eliminar</button></td></tr>");
		});
	});
}

function Eliminar(btn){
	var route = "http://localhost:8000/genero/"+btn.value+"";
	var token = $("#token").val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'DELETE',
		dataType: 'json',
		success: function(){
			Carga();
			$("#msj-success").fadeIn();
		}
	});
}

function Mostrar(btn){
	var route = "http://localhost:8000/genero/"+btn.value+"/edit";

	$.get(route, function(res){
		$("#gender").val(res.gender);
		$("#id").val(res.id);
	});
}

$("#actualizar").click(function(){
	var value = $("#id").val();
	var dato = $("#gender").val();
	var route = "http://localhost:8000/genero/"+value+"";
	var token = $("#token").val();

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data: {gender: dato},
		success: function(){
			Carga();
			$("#myModal").modal('toggle');
			$("#msj-success").fadeIn();
		}
	});
});