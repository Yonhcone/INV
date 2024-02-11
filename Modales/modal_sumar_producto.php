<div class="modal fade" id="modalSumarProducto" tabindex="-1" role="dialog" aria-labelledby="modalSumarProductoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSumarProductoLabel">Sumar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding-top: 5px; padding-bottom: 5px;">
        <p style="font-size: 14px; line-height: 1.2;"><strong>El ID del producto es:</strong> <span id="idProducto"></span></p>
        <p style="font-size: 14px; line-height: 1.2;"><strong>La cantidad en stock es:</strong> <span id="cantidadStock"></span></p>
        <p style="font-size: 14px; line-height: 1.2;"><strong>Nombre del producto:</strong> <span id="nombreProducto"></span></p>
        <p style="font-size: 14px; line-height: 1.2;"><strong>Descripción del producto:</strong> <span id="descripcionProducto"></span></p>
        <p style="font-size: 14px; line-height: 1.2;"><strong>Código de barras:</strong> <span id="codigoBarras"></span></p>
        <div class="form-group" style="margin-top: 10px;">
          <label for="cantidadAgregar" style="font-size: 14px;">Cantidad a agregar:</label>
          <input type="number" class="form-control" id="cantidadAgregar" name="cantidadAgregar" placeholder="Ingrese la cantidad" min="1" step="1" required>
        </div>
        <p style="font-size: 14px; line-height: 1.2;"><strong>La cantidad luego de agregar será:</strong> <span id="cantidadTotal"></span></p>
        <div style="text-align: center;">
          <img id="imagenProducto" src="" alt="Imagen del producto" style="width: 100px; height: 100px; display: inline-block;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<script>
  function guardarCambios() {
    // Aquí puedes agregar el código para guardar los cambios
  }

  // Función para calcular la cantidad total después de agregar
  document.getElementById('cantidadAgregar').addEventListener('input', function() {
    var cantidadAgregar = parseInt(this.value);
    var cantidadStock = parseInt(document.getElementById('cantidadStock').textContent);
    if (!isNaN(cantidadAgregar)) {
      var cantidadTotal = cantidadStock + cantidadAgregar;
      document.getElementById('cantidadTotal').textContent = cantidadTotal;
      this.classList.remove('input-error');
    } else {
      document.getElementById('cantidadTotal').textContent = '';
      this.classList.add('input-error');
    }
  });

  $(document).ready(function() {
    $('#btnGuardarCambios').click(function() {
        // Obtener el valor del input de cantidad
        var cantidadAAgregar = $('#inputCantidad').val();

        // Verificar si el campo de cantidad está vacío o no contiene un número
        if (cantidadAAgregar === '' || isNaN(cantidadAAgregar)) {
            // Si el campo está vacío o no es un número, mostrar un mensaje de error
            $('#inputCantidad').addClass('is-invalid');
            $('#mensajeError').text('Por favor ingresa una cantidad válida.');
        } else {
            // Si la cantidad es válida, enviar la solicitud AJAX para actualizar el stock
            $.ajax({
                url: 'ajax/actualizar_stock.php',
                type: 'POST',
                dataType: 'json',
                data: { cantidad: cantidadAAgregar },
                success: function(response) {
                    if (response.status === 'success') {
                        // Si la actualización fue exitosa, mostrar un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message
                        });
                    } else {
                        // Si hubo un error, mostrar un mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Si hay un error en la solicitud AJAX, mostrar un mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al procesar la solicitud.'
                    });
                }
            });
        }
    });
});



</script>

<style>
  .input-error {
    border-color: red;
  }
</style>
