<?php
// Incluir el archivo de conexión a la base de datos
include('../php/conexion.php');

// Verificar si la solicitud es a través de POST y si se enviaron los datos necesarios
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cantidad"]) && isset($_POST["idProducto"])) {
    // Obtener la cantidad y el ID del producto del formulario
    $cantidad = $_POST["cantidad"];
    $idProducto = $_POST["idProducto"];

    try {
        // Verificar si la cantidad es un número válido
        if (!is_numeric($cantidad) || $cantidad <= 0) {
            throw new Exception("La cantidad ingresada no es válida");
        }

        // Consulta SQL para actualizar el stock del producto
        $sql = "UPDATE productos SET cantidad_stock = cantidad_stock + ? WHERE id = ?";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Vincular los parámetros y ejecutar la consulta
        $stmt->bind_param("ii", $cantidad, $idProducto);
        $stmt->execute();

        // Verificar si se realizó la actualización correctamente
        if ($stmt->affected_rows > 0) {
            // Enviar una respuesta de éxito si se actualizó el stock correctamente
            echo json_encode(array("success" => true, "message" => "Stock actualizado con éxito"));
        } else {
            // Enviar una respuesta de error si no se actualizó ninguna fila
            throw new Exception("No se pudo actualizar el stock del producto");
        }

        // Cerrar la conexión a la base de datos
        $stmt->close();
    } catch (Exception $e) {
        // Enviar una respuesta de error con el mensaje de la excepción
        echo json_encode(array("success" => false, "message" => "Error en la actualización del stock: " . $e->getMessage()));
    }
} else {
    // Enviar una respuesta de error si la solicitud no es válida o faltan parámetros
    echo json_encode(array("success" => false, "message" => "Solicitud no válida o faltan parámetros"));
}
?>
