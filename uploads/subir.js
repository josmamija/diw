function subirArchivos() {
      $("#archivo").upload('../uploads/subir_archivo.php',
      {
         nombre_archivo: $("#nombre_archivo").val()
      },
      function(respuesta) {
         //Subida finalizada.
         $("#barra_de_progreso").val(0);
         if (respuesta === 1) {
            mostrarRespuesta('<span class="titulopetit">El archivo '+ $("#archivo").val() + ' ha sido subido correctamente.</span>', true);
			document.getElementById("adjunto").value="1";
            $("#nombre_archivo, #archivo").val('');
         } else if(respuesta === 0){
            mostrarRespuesta('<span class="rojo">El archivo NO se ha podido subir.</span>', false);
         } else {
			 mostrarRespuesta('<span class="rojo">Error: El archivo debe ser tipo PDF.</span>', false);
		 }
		 
         mostrarArchivos();
         }, function(progreso, valor) {
            //Barra de progreso.
            $("#barra_de_progreso").val(valor);
         });
   }
   function eliminarArchivos(archivo) {
      $.ajax({
         url: '../uploads/eliminar_archivo.php',
         type: 'POST',
         timeout: 10000,
         data: {archivo: archivo},
         error: function() {
            mostrarRespuesta('Error al intentar eliminar el archivo.', false);
         },
         success: function(respuesta) {
            if (respuesta == 1) {
               mostrarRespuesta('El archivo ha sido eliminado.', true);
            } else {
               mostrarRespuesta('Error al intentar eliminar el archivo.', false); 
            }
            mostrarArchivos();
         }
      });
   }
   function mostrarArchivos() {
	   var archivo = $("#nombre_archivo").val(); 
      $.ajax({
         url: '../uploads/mostrar_archivos.php',
		  type: 'POST',
         dataType: 'JSON',
		 data: {nombre_archivo : archivo},
         success: function(respuesta) {
            if (respuesta) {
               var html = '';
               for (var i = 0; i < respuesta.length; i++) {
                  if (respuesta[i] != undefined) {
                     html += '<div class="row"> <span class="col-lg-2"> ' + respuesta[i] + ' </span> </div> <hr />';
                  }
               }
               $("#archivos_subidos").html(html);
            }
         }
      });
   }
   
   
   
   
    function mostrarArchivos2() {
      $.ajax({
         url: '../uploads/mostrar_archivos.php',
         dataType: 'JSON',
         success: function(respuesta) {
            if (respuesta) {
               var html = '';
               for (var i = 0; i < respuesta.length; i++) {
                  if (respuesta[i] != undefined) {
                     html += '<div class="row"> <span class="col-lg-2"> ' + respuesta[i] + ' </span> <div class="col-lg-2"> <a class="eliminar_archivo btn btn-danger" href="javascript:void(0);"> Eliminar </a> </div> </div> <hr />';
                  }
               }
               $("#archivos_subidos").html(html);
            }
         }
      });
   }
   
   
   function mostrarRespuesta(mensaje, ok){
      $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
      if(ok){
         $("#respuesta").addClass('alert-success');
      }else{
         $("#respuesta").addClass('alert-danger');
      }
   }
   $(document).ready(function() {
	  
      mostrarArchivos();
	  
      $("#boton_subir").on('click', function() {
         subirArchivos();
      });
	  
	 
      $("#archivos_subidos").on('click', '.eliminar_archivo', function() {
         var archivo = $(this).parents('.row').eq(0).find('span').text();
         archivo = $.trim(archivo);
         eliminarArchivos(archivo);
      });
	
   });
   