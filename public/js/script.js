$("#registro").click(function(){
    var dato = $("#gender").val();
    var route = "/genero";
    var token = $("#token").val();

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{gender: dato},

        success:function(){
            $("#msj-success").fadeIn();
        },
        error:function(msj){
            $("#msj").html(msj.responseJSON.gender);
            $("#msj-error").fadeIn();
        }
    });
});


