// Shorthand for $( document ).ready()
$(function() {
    $("#users_table").DataTable({
        
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }

    });
});


// Muestra temporal de la foto del usuario
$("input[name='avatar']").change(function(){
    var imagen = this.files[0];    
    // Validamos el formato
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
  
    $("input[name='avatar']").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
        });
    } else if(imagen["size"] > 2000000){  
        $("input[name='avatar']").val("");
        swal({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });  
      } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);  
        $(datosImagen).on("load", function(event){  
          var rutaImagen = event.target.result;  
          $(".previsualizarAvatar").attr("src", rutaImagen);  
        })  
      }  
  });

  // EDITAR USUARIO
  $("#users_table").on('click', '.btnEditarUsuario', function () {
    const userid = $(this).data('userid');
    
    var params = new FormData();
    params.append('userid', userid);

    
	$.ajax({
		url:"ajax/users.ajax.php",
		method: "POST",
		data: params,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
            let img_avatar = '';
            if (data['foto'] != '')
                img_avatar = 'view/img/users/' +data['foto'];
            if (img_avatar == '')
                img_avatar = 'view/img/users/none.jpg';

			$("#user_edit").val(userid);
			$("#rol_edit").val(data["rol"]);
			$("#nombre_edit").val(data["nombre"]);
			$("#apellido1_edit").val(data["apellido1"]); 
			$("#apellido2_edit").val(data["apellido2"]);
			$("#email_edit").val(data["email"]);
			$("#usuario_edit").val(data["username"]);
			$("#clave_ant").val(data["password"]);

			$(".previsualizarAvatar_edit").attr("src", img_avatar);
			
            $('#avatar_edit_ant').val(data['foto']);
		}
	});

  });

  // ELIMINAR USUARIO
  $("#users_table").on('click', '.btnEliminarUsuario', function () {
    const userid = $(this).data('userid');
    const user_img = $(this).data('userimg');
    
    swal({
		title: '¿Está seguro de eliminar este usario?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar usuario!'
	}).then(function(result) {

		if (result.value) {			
            var params = new FormData();
            params.append('action', 'delete');
            params.append('userid', userid);
            params.append('userimg', user_img);

			$.ajax({
				url:"ajax/users.ajax.php",
				method: "POST",
				data: params,
				cache: false,
				contentType: false,
				processData: false,
				success:function (respuesta) {
					if (respuesta == "ok") {
						swal({
							type: "success",
							title: "¡CORRECTO!",
							text: "El usuario ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function (result) {
                            window.location = "users";			
                        }); 
                    }
                }
            });
        }
    });
  });