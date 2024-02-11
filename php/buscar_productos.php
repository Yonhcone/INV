<?php
include('conexion.php');

$searchTerm = $_POST['searchTerm'];
$sql = "SELECT id, nombre_producto, descripcion_producto, precio_venta, costo_adquisicion, cantidad_stock, codigo_barras, ubicacion_inventario, proveedor, imagen_producto
        FROM productos
        WHERE nombre_producto LIKE '%$searchTerm%'
           OR descripcion_producto LIKE '%$searchTerm%'
           OR codigo_barras LIKE '%$searchTerm%'
           OR ubicacion_inventario LIKE '%$searchTerm%'
           OR proveedor LIKE '%$searchTerm%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Obtener la ruta de la imagen del producto desde la base de datos
        $imagenProducto = $row['imagen_producto'];

        // Verificar si la imagen existe en la carpeta o si está vacía
        if (!file_exists($imagenProducto) || empty($imagenProducto)) {
            // Si la imagen no existe o está vacía, establecer la ruta predeterminada
            $imagenProducto = 'img/productos/404.jpg';
        }

        echo '<tr> 
                <td>' . $row['codigo_barras'] . '</td>
                <td class="single-line-text">' . $row['nombre_producto'] . '</td>
                <td id="descripcion_' . $row['id'] . '" class="expandir-texto" data-descripcion="' . $row['descripcion_producto'] . '"
                    onclick="toggleDescripcion(this)">' . $row['descripcion_producto'] . '</td>
                <td>' . $row['precio_venta'] . '</td>
                <td>' . $row['cantidad_stock'] . '</td>
                <td>
                    <div class="btn-group btn-group-horizontal">
                        <button class="btn btn-sm btn-secondary" title="Copiar"
                            data-id="' . $row['id'] . '"
                            data-nombre="' . $row['nombre_producto'] . '"
                            data-descripcion="' . $row['descripcion_producto'] . '"
                            data-precio="' . $row['precio_venta'] . '"
                            data-costo="' . $row['costo_adquisicion'] . '"
                            data-cantidad="' . $row['cantidad_stock'] . '"
                            data-codigo-barras="' . $row['codigo_barras'] . '"
                            data-ubicacion="' . $row['ubicacion_inventario'] . '"
                            data-proveedor="' . $row['proveedor'] . '"
                            data-toggle="modal"
                            data-target="#myModal"
                            onclick="abrirModalCopiar(this)">
                            <i class="fas fa-copy"></i>
                        </button>
                        
                        <button class="btn btn-sm btn-info" title="Editar"
                        data-id="' . $row['id'] . '"
                        data-codigo-barras="' . $row['codigo_barras'] . '"
                        data-nombre="' . $row['nombre_producto'] . '"
                        data-descripcion="' . $row['descripcion_producto'] . '"
                        data-precio="' . $row['precio_venta'] . '"
                        data-costo="' . $row['costo_adquisicion'] . '"
                        data-cantidad="' . $row['cantidad_stock'] . '"
                        data-ubicacion="' . $row['ubicacion_inventario'] . '"
                        data-proveedor="' . $row['proveedor'] . '"
                        onclick="editarProducto(this)">
                        <i class="fas fa-edit"></i>
                    </button>
                    
                        <button class="btn btn-sm btn-warning" title="Restar">
                            <i class="fas fa-minus"></i>

                            <button type="button" class="btn btn-success" id="btnAbrirModalSumar" data-toggle="modal" data-target="#modalSumarProducto" onclick="abrirModalSumar(this)" data-producto-id="' . $row['id'] . '" data-cantidad-stock="' . $row['cantidad_stock'] . '" data-nombre-producto="' . $row['nombre_producto'] . '" data-descripcion-producto="' . $row['descripcion_producto'] . '" data-codigo-barras="' . $row['codigo_barras'] . '" data-imagen-producto="' . $imagenProducto . '">
                            <i class="fas fa-plus"></i> 
                        </button>
                        
                        
                        <button class="btn btn-sm btn-danger" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                        <!-- Agrega aquí otros botones y acciones según sea necesario -->
                    </div>
                </td>
            </tr>';
    }
    
} else {
    echo '<tr><td colspan="6">No se encontraron resultados</td></tr>';
}

$conn->close();
?>
