// Shorthand for $( document ).ready()
$(function() {
    $("#roles_table").DataTable({
        
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

  // EDITAR ROL
  $("#roles_table").on('click', '.btnEditarRol', function () {
    const rol_id = $(this).data('rol_id');
    
    var params = new FormData();
    params.append('rol_id', rol_id);

	$.ajax({
		url:"ajax/roles.ajax.php",
		method: "POST",
		data: params,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (data) {
            $("#rol_edit").val(rol_id);
			$("#nombre_edit").val(data["rol"]);
		}
	});

  });

  // ELIMINAR ROL
  $("#roles_table").on('click', '.btnEliminarRol', function () {
    const rol_id = $(this).data('rol_id');
    
    swal({
		title: '¿Está seguro de eliminar este rol?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, eliminar rol!'
	}).then(function(result) {

		if (result.value) {			
            var params = new FormData();
            params.append('action', 'delete');
            params.append('rol_id', rol_id);

			$.ajax({
				url:"ajax/roles.ajax.php",
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
							text: "El rol ha sido borrado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function (result) {
                            window.location = "roles";			
                        }); 
                    }
                }
            });
        }
    });
  });