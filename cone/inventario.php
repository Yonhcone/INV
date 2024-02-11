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
      max-width: 400px; 
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
          <button type="button" class="btn btn-primary" id="btnCopiar">Actualizar</button>
          <button class="btn btn-sm btn-warning" id="btnEditar" style="display: none;" onclick="editarProducto()">Editar</button>

          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Asegúrate de incluir jQuery antes de este script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
  $(document).ready(function(){
    // Manejador de evento keyup para #searchInput
    $('#searchInput').on('keyup', function(){
      // Obtener el valor del campo de entrada
      var searchTerm = $(this).val();

      // Realizar la solicitud AJAX
      $.ajax({
        url: 'php/buscar_productos.php',
        method: 'POST',
        data: { searchTerm: searchTerm },
        success: function(data){
          // Reemplazar el contenido de la tabla con los resultados de la búsqueda
          $('#tablaProductos tbody').html(data);
        },
        error: function(){
          // Manejar errores si es necesario
          alert('Error en la solicitud AJAX');
        }
      });
    });
  });
</script>
<!-- Agrega este script en tu HTML después de jQuery y antes de cerrar el body -->
<script>
function abrirModalCopiar(btn) {
    // Obtener los valores de los atributos data del botón
    var codigoBarras = $(btn).data('codigo-barras');
    var nombreProducto = $(btn).data('nombre');
    var descripcionProducto = $(btn).data('descripcion');
    var precioVenta = $(btn).data('precio');
    var costoAdquisicion = $(btn).data('costo');
    var cantidadStock = $(btn).data('cantidad');
    var ubicacionInventario = $(btn).data('ubicacion');
    var proveedor = $(btn).data('proveedor');

    // Actualizar los campos del formulario en el modal con los valores obtenidos
    $('#modal-codigo-barras').val(codigoBarras);
    $('#modal-nombre').val(nombreProducto);
    $('#modal-descripcion').val(descripcionProducto);
    $('#modal-precio').val(precioVenta);
    $('#modal-costo').val(costoAdquisicion);
    $('#modal-cantidad').val(cantidadStock);
    $('#modal-ubicacion').val(ubicacionInventario);
    $('#modal-proveedor').val(proveedor);

    // Crear el nuevo botón "Copiar Productos"
    var nuevoBoton = $('<button class="btn btn-sm btn-primary" id="btnCopiarProductos" onclick="copiarProductos()">Copiar Productos</button>');

    // Reemplazar el botón "Actualizar" dentro del modal con el nuevo botón
    $('#btnCopiar').replaceWith(nuevoBoton);

    // Abrir el modal
    $('#myModal').modal('show');
}
function editarProducto(btn) {
    // Obtener los valores de los atributos data del botón
    var codigoBarras = $(btn).data('codigo-barras');
    var nombreProducto = $(btn).data('nombre');
    var descripcionProducto = $(btn).data('descripcion');
    var precioVenta = $(btn).data('precio');
    var costoAdquisicion = $(btn).data('costo');
    var cantidadStock = $(btn).data('cantidad');
    var ubicacionInventario = $(btn).data('ubicacion');
    var proveedor = $(btn).data('proveedor');

    // Actualizar los campos del formulario en el modal con los valores obtenidos
    $('#modal-codigo-barras').val(codigoBarras);
    $('#modal-nombre').val(nombreProducto);
    $('#modal-descripcion').val(descripcionProducto);
    $('#modal-precio').val(precioVenta);
    $('#modal-costo').val(costoAdquisicion);
    $('#modal-cantidad').val(cantidadStock);
    $('#modal-ubicacion').val(ubicacionInventario);
    $('#modal-proveedor').val(proveedor);

    // Ocultar ambos botones al abrir el modal
    $('#btnCopiar, #btnEditar').hide();

    // Mostrar el botón correspondiente
    if (btn.id === 'btnCopiar') {
        $('#btnCopiar').show();
    } else if (btn.id === 'btnEditar') {
        $('#btnEditar').show();
    }

    // Abrir el modal
    $('#myModal').modal('show');
}


</script>
