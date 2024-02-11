$(document).ready(function() {
    // Configurar el evento click para el botón "Guardar cambios" del modal
    $('#modalSumarProducto .btn-primary').on('click', function() {
        // Obtener el valor del input de cantidad a agregar
        var cantidadAgregar = $('#cantidadAgregar').val();

        // Verificar si el valor ingresado es un número válido
        if (!(/^\d+$/.test(cantidadAgregar))) {
            // Mostrar un mensaje de error si no es un número válido
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, ingrese solo números en el campo de cantidad.'
            });
            return; // Salir de la función
        }

        // Obtener el ID del producto
        var idProducto = $('#idProducto').text();

        // Realizar la solicitud AJAX para actualizar el stock
        $.ajax({
            url: 'ajax/actualizar_stock.php',
            type: 'POST',
            data: {
                idProducto: idProducto,
                cantidad: cantidadAgregar
            },
            dataType: 'json',
            success: function(response) {
                // Verificar si la actualización fue exitosa
                if (response.success) {
                    // Mostrar un mensaje de éxito si la actualización fue exitosa
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message
                    });
                } else {
                    // Mostrar un mensaje de error si hubo un problema durante la actualización
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Mostrar un mensaje de error si hubo un error en la solicitud AJAX
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al procesar la solicitud AJAX: ' + error
                });
            }
        });
    });
});
