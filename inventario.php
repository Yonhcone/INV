<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tabla Bootstrap con Botones y Formulario Modal</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .single-line-text {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .expandir-texto {
      cursor: pointer;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 400px; /* Ancho máximo antes de la expansión */
    }
     .expandido {
      white-space: normal;
      overflow: visible;
    }

    .btn-group-horizontal {
      display: flex;
    }

    .btn-group-horizontal .btn {
      margin-right: 5px;
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2 class="mb-4">Tabla con Botones</h2>
  <div class="form-group">
    <label for="searchInput">Buscar Producto:</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Escribe para buscar" onkeyup="buscarProductos()">
  </div>
  <div class="table-responsive">
    <table id="tablaProductos" class="table table-sm table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 20%">Codigo de Barras</th>
          <th style="width: 20%" class="single-line-text">Nombre Producto</th>
          <th style="width: 20%">Descripción Producto</th>
          <th style="width: 10%">Precio Venta</th>
          <th style="width: 10%">Stock</th>
          <th style="width: 20%">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aquí deberías agregar dinámicamente las filas de la tabla con PHP -->
      </tbody>
    </table>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Copiar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
        <form id="copiarForm">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="modal-codigo-barras">Código de Barras:</label>
              <input type="text" class="form-control" id="modal-codigo-barras" name="codigo_barras" placeholder="Código de barras" >
            </div>
            <div class="form-group col-md-8">
              <label for="modal-nombre">Nombre Producto:</label>
              <input type="text" class="form-control" id="modal-nombre" name="nombre_producto" placeholder="Nombre del producto">
            </div>
          </div>
          <div class="form-group">
            <label for="modal-descripcion">Descripción:</label>
            <textarea class="form-control" id="modal-descripcion" name="descripcion_producto" placeholder="Descripción del producto"></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="modal-precio">Precio Venta:</label>
              <input type="text" class="form-control" id="modal-precio" name="precio_venta" placeholder="Precio de venta">
            </div>
            <div class="form-group col-md-4">
              <label for="modal-costo">Costo de Adquisición:</label>
              <input type="text" class="form-control" id="modal-costo" name="costo_adquisicion" placeholder="Costo de adquisición">
            </div>
            <div class="form-group col-md-4">
              <label for="modal-cantidad">Cantidad Stock:</label>
              <input type="text" class="form-control" id="modal-cantidad" name="cantidad_stock" placeholder="Cantidad en stock">
            </div>
          </div>
          <div class="form-group">
            <label for="modal-ubicacion">Ubicación en Inventario:</label>
            <input type="text" class="form-control" id="modal-ubicacion" name="ubicacion_inventario" placeholder="Ubicación en inventario">
          </div>
          <div class="form-group">
            <label for="modal-proveedor">Proveedor:</label>
            <input type="text" class="form-control" id="modal-proveedor" name="proveedor" placeholder="Proveedor">
          </div>
          <!-- Agrega más campos según sea necesario -->
        

        </form>
      </div>
      <div class="modal-footer">
  <button type="button" class="btn btn-primary btn-editar-copiar mr-auto" id="btnCopiar" onclick="editarCopiarProducto(this)">Copiar Producto</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>

    </div>
  </div>
</div>
<!-- Asegúrate de incluir SweetAlert y jQuery en tu proyecto antes de estos scripts -->
<!-- Modal para Editar -->
<div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelEditar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabelEditar">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
        <form id="editarForm">
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="modal-codigo-barras-editar">Código de Barras:</label>
              <input type="text" class="form-control" id="modal-codigo-barras-editar" name="codigo_barras" placeholder="Código de barras" >
            </div>
            <div class="form-group col-md-8">
              <label for="modal-nombre-editar">Nombre Producto:</label>
              <input type="text" class="form-control" id="modal-nombre-editar" name="nombre_producto" placeholder="Nombre del producto">
            </div>
          </div>
          <div class="form-group">
            <label for="modal-descripcion-editar">Descripción:</label>
            <textarea class="form-control" id="modal-descripcion-editar" name="descripcion_producto" placeholder="Descripción del producto"></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="modal-precio-editar">Precio Venta:</label>
              <input type="text" class="form-control" id="modal-precio-editar" name="precio_venta" placeholder="Precio de venta">
            </div>
            <div class="form-group col-md-4">
              <label for="modal-costo-editar">Costo de Adquisición:</label>
              <input type="text" class="form-control" id="modal-costo-editar" name="costo_adquisicion" placeholder="Costo de adquisición">
            </div>
            <div class="form-group col-md-4">
              <label for="modal-cantidad-editar">Cantidad Stock:</label>
              <input type="text" class="form-control" id="modal-cantidad-editar" name="cantidad_stock" placeholder="Cantidad en stock">
            </div>
          </div>
          <div class="form-group">
            <label for="modal-ubicacion-editar">Ubicación en Inventario:</label>
            <input type="text" class="form-control" id="modal-ubicacion-editar" name="ubicacion_inventario" placeholder="Ubicación en inventario">
          </div>
          <div class="form-group">
            <label for="modal-proveedor-editar">Proveedor:</label>
            <input type="text" class="form-control" id="modal-proveedor-editar" name="proveedor" placeholder="Proveedor">
          </div>
          <!-- Agrega más campos según sea necesario -->
          <input type="text" id="modal-id-editar" name="id" >

        </form>
      </div>
      <div class="modal-footer">
        <!-- Modifica el botón de "Editar Producto" en el modal de edición -->
        <button type="button" class="btn btn-primary btn-editar mr-auto" id="btnEditar">Editar Producto</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>


    </div>
  </div>
</div>
<?php include('modales/modal_sumar_producto.php'); ?>

<script src="js/actualizar_stock.js"></script>

<script>
function abrirModalSumar(boton) {
    var idProducto = boton.getAttribute('data-producto-id');
    var cantidadStock = boton.getAttribute('data-cantidad-stock');
    var nombreProducto = boton.getAttribute('data-nombre-producto');
    var descripcionProducto = boton.getAttribute('data-descripcion-producto');
    var codigoBarras = boton.getAttribute('data-codigo-barras');
    var imagenProducto = boton.getAttribute('data-imagen-producto'); // Modificado

    // Verificar si la imagen del producto existe en el servidor
    $.ajax({
        url: imagenProducto,
        type: 'HEAD',
        success: function() {
            // Si la imagen existe, asignar la fuente de la imagen
            document.getElementById('imagenProducto').src = imagenProducto;
        },
        error: function() {
            // Si la imagen no existe, asignar la imagen predeterminada
            document.getElementById('imagenProducto').src = 'img/productos/404.jpg';
        }
    });

    document.getElementById('idProducto').textContent = idProducto;
    document.getElementById('cantidadStock').textContent = cantidadStock;
    document.getElementById('nombreProducto').textContent = nombreProducto;
    document.getElementById('descripcionProducto').textContent = descripcionProducto;
    document.getElementById('codigoBarras').textContent = codigoBarras;
}


</script>
<script>
    $(document).ready(function () {
        // Manejar clic en el botón de copiar
        $('#btnCopiar').on('click', function () {
            // Obtener los datos del formulario
            var formData = $('#copiarForm').serialize();

            // Realizar la solicitud AJAX
            $.ajax({
                url: 'php/copiar_producto.php',
                type: 'POST',
                data: formData,
                dataType: 'json',  // Esperar una respuesta JSON
                success: function (response) {
                    if (response.success) {
                        // Usar SweetAlert para mostrar una alerta de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Copia del producto realizada con éxito'
                        }).then(function () {
                            // Cerrar el modal después de copiar
                            $('#myModal').modal('hide');
                        });
                    } else {
                        // Usar SweetAlert para mostrar una alerta de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error: ' + response.message
                        });
                    }
                },
                error: function (error) {
                    // Usar SweetAlert para mostrar una alerta de error en caso de un error AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la solicitud AJAX: ' + error.statusText
                    });
                }
            });
        });

        
        // Otras funciones y eventos aquí...

        // ...

        // Función para editar un producto
        function editarProducto(boton) {
            // ... (código previo)

            // Cambiar el texto del botón Copiar a Editar Producto
            $('#btnCopiar').text('Editar Producto');

            // Agregar la clase que identifica el estado actual del botón
            $('#btnCopiar').addClass('btn-editar');

            // Cambiar la acción del formulario para la edición
            $('#copiarForm').attr('action', 'php/editar_producto.php');

            // ... (código posterior)

            // Muestra el modal
            $('#myModal').modal('show');
        }

        // Función para editar o copiar un producto
        function editarCopiarProducto(boton) {
            console.log('Botón clicado:', boton);

            if ($(boton).hasClass('btn-editar')) {
                // Lógica para el estado "Editar Producto"
                // ...

                // Obtener los datos del formulario
                var formData = $('#copiarForm').serialize();

                // Realizar la solicitud AJAX para editar el producto
                $.ajax({
                    url: 'php/editar_producto.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            // Usar SweetAlert para mostrar una alerta de éxito
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: 'Edición del producto realizada con éxito'
                            }).then(function () {
                                // Cerrar el modal después de editar
                                $('#myModal').modal('hide');
                            });
                        } else {
                            // Usar SweetAlert para mostrar una alerta de error
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error: ' + response.message
                            });
                        }
                    },
                    error: function (error) {
                        // Usar SweetAlert para mostrar una alerta de error en caso de un error AJAX
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error en la solicitud AJAX: ' + error.statusText
                        });
                    }
                });
            } else {
                // Lógica para el estado "Copiar Producto"
                // ...
            }
        }
    });
</script>

<script>
    function abrirModal(boton) {
        
        var codigoBarras = boton.getAttribute('data-codigo-barras');
        var nombre = boton.getAttribute('data-nombre');
        var descripcion = boton.getAttribute('data-descripcion');
        var precio = boton.getAttribute('data-precio');
        var costo = boton.getAttribute('data-costo');
        var cantidad = boton.getAttribute('data-cantidad');
        var ubicacion = boton.getAttribute('data-ubicacion');
        var proveedor = boton.getAttribute('data-proveedor');

        // Configura el formulario con los datos del producto
        document.getElementById('modal-codigo-barras').value = codigoBarras;
        document.getElementById('modal-nombre').value = nombre;
        document.getElementById('modal-descripcion').value = descripcion;
        document.getElementById('modal-precio').value = precio;
        document.getElementById('modal-costo').value = costo;
        document.getElementById('modal-cantidad').value = cantidad;
        document.getElementById('modal-ubicacion').value = ubicacion;
        document.getElementById('modal-proveedor').value = proveedor;

        // Establece la acción del formulario para la copia
        $('#copiarForm').attr('action', 'php/copiar_producto.php');

        // Muestra el modal
        $('#myModal').modal('show');
    }

    function toggleDescripcion(elemento) {
        // Toggle de la clase 'expandido' para mostrar u ocultar el texto completo
        elemento.classList.toggle('expandido');
    }

    function buscarProductos() {
        // Obtén el valor del input de búsqueda
        var searchTerm = document.getElementById('searchInput').value;

        // Verifica si el término de búsqueda está vacío
        if (searchTerm.trim() === '') {
            // Muestra la tabla con todas las filas vacías
            $('#tablaProductos tbody').html('<tr><td colspan="6">No se encontraron resultados</td></tr>');
            return;
        }

        // Realiza la solicitud AJAX al servidor
        $.ajax({
            url: 'php/buscar_productos.php',
            type: 'POST',
            data: { searchTerm: searchTerm },
            success: function (data) {
                console.log('Respuesta del servidor:', data);
                // Actualiza solo las filas de datos, no los encabezados ni los botones
                $('#tablaProductos tbody').html(data);
            },
            error: function (error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    }

    $(document).ready(function() {
        buscarProductos();

        $('#searchInput').on('keyup', function() {
            buscarProductos();
        });
    });
</script>

<script>
   

    function editarCopiarProducto(boton) {
        console.log('Botón clicado:', boton);

        if ($(boton).hasClass('btn-editar')) {
            // Lógica para el estado "Editar Producto"
            // ...

            // Obtener los datos del formulario
            var formData = $('#copiarForm').serialize();

            // Realizar la solicitud AJAX para editar el producto
            $.ajax({
                url: 'php/editar_producto.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    // Usar SweetAlert para mostrar el mensaje devuelto por el servidor
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.success ? 'Éxito' : 'Error',
                        text: response.message
                    }).then(function () {
                        // Cerrar el modal después de editar
                        $('#myModal').modal('hide');
                        
                        // Puedes realizar más acciones después de mostrar el mensaje si es necesario
                    });
                },
                error: function (error) {
                    // Usar SweetAlert para mostrar una alerta de error en caso de un error AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error en la solicitud AJAX: ' + error.statusText
                    });
                }
            });
        } else {
            // Lógica para el estado "Copiar Producto"
            // ...
        }
    }

    function resetearFormulario() {
        // Restablecer el formulario a su estado original
        $('#copiarForm').get(0).reset();

        // Cambiar el texto del elemento h5 con el id "exampleModalLabel"
        $('#exampleModalLabel').text('Copiar Producto');

        // Cambiar el texto del botón Editar Producto a Copiar Producto
        $('#btnCopiar').text('Copiar Producto');

        // Quitar la clase que identifica el estado actual del botón
        $('#btnCopiar').removeClass('btn-editar');

        // Restablecer la acción del formulario para la copia
        $('#copiarForm').attr('action', 'php/copiar_producto.php');
    }

    function abrirModalCopiar(boton) {
        // Restablecer el formulario antes de abrir el modal para copiar
        resetearFormulario();

        // Obtener datos del producto del botón y configurar el formulario
        var id = $(boton).data('id'); // Obtener el ID del producto
        var codigoBarras = $(boton).data('codigo-barras');
        var nombre = $(boton).data('nombre');
        var descripcion = $(boton).data('descripcion');
        var precio = $(boton).data('precio');
        var costo = $(boton).data('costo');
        var cantidad = $(boton).data('cantidad');
        var ubicacion = $(boton).data('ubicacion');
        var proveedor = $(boton).data('proveedor');

        // Asignar los valores a los campos del formulario
        $('#modal-id').val(id);
        document.getElementById('modal-codigo-barras').value = codigoBarras;
        document.getElementById('modal-nombre').value = nombre;
        document.getElementById('modal-descripcion').value = descripcion;
        document.getElementById('modal-precio').value = precio;
        document.getElementById('modal-costo').value = costo;
        document.getElementById('modal-cantidad').value = cantidad;
        document.getElementById('modal-ubicacion').value = ubicacion;
        document.getElementById('modal-proveedor').value = proveedor;

        // Muestra el modal
        $('#myModal').modal('show');
    }
</script>
<!-- Agrega este bloque de script dentro de tu etiqueta <script> en el archivo HTML -->
  
<script>
   // Función para editar un producto
function editarProducto(boton) {
    // Obtener los datos del producto del botón
    var idProducto = $(boton).data('id');
    var codigoBarras = $(boton).data('codigo-barras');
    var nombre = $(boton).data('nombre');
    var descripcion = $(boton).data('descripcion');
    var precio = $(boton).data('precio');
    var costo = $(boton).data('costo');
    var cantidad = $(boton).data('cantidad');
    var ubicacion = $(boton).data('ubicacion');
    var proveedor = $(boton).data('proveedor');

    // Configura el formulario con los datos del producto
    $('#modal-id-editar').val(idProducto);
    $('#modal-codigo-barras-editar').val(codigoBarras);
    $('#modal-nombre-editar').val(nombre);
    $('#modal-descripcion-editar').val(descripcion);
    $('#modal-precio-editar').val(precio);
    $('#modal-costo-editar').val(costo);
    $('#modal-cantidad-editar').val(cantidad);
    $('#modal-ubicacion-editar').val(ubicacion);
    $('#modal-proveedor-editar').val(proveedor);

    // Cambiar el texto del elemento h5 con el id "exampleModalLabelEditar"
    $('#exampleModalLabelEditar').text('Editar Producto');

    // Muestra el modal de edición
    $('#myModalEditar').modal('show');
}

</script>

<script>

  
    $(document).ready(function () {
        // ... Otro código ...

        // Agregar el evento click al botón de editar en el modal de edición
        $('#btnEditar').on('click', function () {
            // Puedes realizar acciones específicas al hacer clic en el botón "Editar" aquí
            alert('Botón "Editar" del modal de edición fue clicado.');
        });

        // ... Otro código ...
    });

    $(document).ready(function () {
    // ... Otro código ...

    // Agregar el evento click al botón de editar en el modal de edición
    $('#btnEditar').on('click', function () {
        // Obtener los datos del formulario de edición
        var formData = $('#editarForm').serialize();

        // Realizar la solicitud AJAX para editar el producto
        $.ajax({
            url: 'php/editar_producto.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                // Usar SweetAlert para mostrar el mensaje devuelto por el servidor
                Swal.fire({
                    icon: response.success ? 'success' : 'error',
                    title: response.success ? 'Éxito' : 'Error',
                    text: response.message
                }).then(function () {
                    // Cerrar el modal después de editar
                    $('#myModalEditar').modal('hide');
                    
                    // Puedes realizar más acciones después de mostrar el mensaje si es necesario
                });
            },
            error: function (error) {
                // Usar SweetAlert para mostrar una alerta de error en caso de un error AJAX
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la solicitud AJAX: ' + error.statusText
                });
            }
        });
    });

    // ... Otro código ...
});


</script>

</body>
</html>