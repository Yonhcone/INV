<?php
include('conexion.php');

// Inicializar la respuesta como un arreglo asociativo
$response = array('success' => false, 'message' => 'Acceso no autorizado');

// Ejemplo: Obtener el usuario actual desde la sesión o proporcionarlo de alguna manera
$usuarioRegistro = "usuario_ejemplo"; // Reemplaza esto con la lógica adecuada para obtener el usuario actual

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
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

    // Realizar la copia en la base de datos (ejemplo)
    $sql = "INSERT INTO productos 
            (codigo_barras, nombre_producto, descripcion_producto, precio_venta, costo_adquisicion, cantidad_stock, ubicacion_inventario, proveedor, usuario_registro)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $codigoBarras, $nombreProducto, $descripcionProducto, $precioVenta, $costoAdquisicion, $cantidadStock, $ubicacionInventario, $proveedor, $usuarioRegistro);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Copia del producto realizada con éxito';
    } else {
        $response['message'] = 'Error al realizar la copia del producto: ' . $stmt->error;
    }

    $stmt->close();
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$conn->close();
?>