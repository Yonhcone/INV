<?php
include('conexion.php');

// Inicializar la respuesta como un arreglo asociativo
$response = array('success' => false, 'message' => 'Acceso no autorizado');

// Ejemplo: Obtener el usuario actual desde la sesión o proporcionarlo de alguna manera
$usuarioModificacion = "usuario_ejemplo"; // Reemplaza esto con la lógica adecuada para obtener el usuario actual
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $idProducto = mysqli_real_escape_string($conn, $_POST['id']); // Recuperar el ID del producto
    $codigoBarras = mysqli_real_escape_string($conn, $_POST['codigo_barras']);
    $nombreProducto = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $descripcionProducto = mysqli_real_escape_string($conn, $_POST['descripcion_producto']);
    $precioVenta = mysqli_real_escape_string($conn, $_POST['precio_venta']);
    $costoAdquisicion = mysqli_real_escape_string($conn, $_POST['costo_adquisicion']);
    $cantidadStock = mysqli_real_escape_string($conn, $_POST['cantidad_stock']);
    $ubicacionInventario = mysqli_real_escape_string($conn, $_POST['ubicacion_inventario']);
    $proveedor = mysqli_real_escape_string($conn, $_POST['proveedor']);

    // Agrega el resto de los campos según sea necesario
    // ...

    // Realizar la inserción en el historial de modificaciones
    $sqlHistorial = "INSERT INTO historial_modificaciones (id, nombre_producto, descripcion_producto, codigo_barras, precio_venta, costo_adquisicion, cantidad_stock, ubicacion_inventario, proveedor, usuario_modificacion, fecha_modificacion)
                     SELECT ?, nombre_producto, descripcion_producto, codigo_barras, precio_venta, costo_adquisicion, cantidad_stock, ubicacion_inventario, proveedor, usuario_modificacion, fecha_modificacion
                     FROM productos
                     WHERE codigo_barras = ?";
    
    $stmtHistorial = $conn->prepare($sqlHistorial);
    $stmtHistorial->bind_param("is", $idProducto, $codigoBarras);
    $stmtHistorial->execute();

    // Realizar la actualización en la base de datos
    $sql = "UPDATE productos 
            SET nombre_producto = ?, 
                descripcion_producto = ?, 
                precio_venta = ?, 
                costo_adquisicion = ?, 
                cantidad_stock = ?, 
                ubicacion_inventario = ?, 
                proveedor = ?, 
                usuario_modificacion = ?, 
                fecha_modificacion = NOW()
            WHERE codigo_barras = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nombreProducto, $descripcionProducto, $precioVenta, $costoAdquisicion, $cantidadStock, $ubicacionInventario, $proveedor, $usuarioModificacion, $codigoBarras);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Producto editado con éxito';
    } else {
        $response['message'] = 'Error al editar el producto: ' . $stmt->error;
    }

    $stmtHistorial->close();
    $stmt->close();
}

// Devolver la respuesta como JSON
echo json_encode($response);
?>
