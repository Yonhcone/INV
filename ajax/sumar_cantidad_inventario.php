<?php

if (isset($_GET['id'])) {
    // Obtener el ID del producto desde la solicitud
    $producto_id = $_GET['id'];

    // Aquí podrías realizar una consulta a la base de datos para obtener los detalles del producto con el ID proporcionado
    // Por ahora, simplemente simularemos una respuesta con un arreglo asociativo de ejemplo

    // Supongamos que obtenemos los detalles del producto desde la base de datos
    $detalles_producto = array(
        'id' => $producto_id,
        'nombre' => 'Producto Ejemplo',
        'precio' => 10.99,
        'descripcion' => 'Este es un producto de ejemplo',
        // Agrega más detalles del producto según sea necesario
    );

    // Devolver los detalles del producto en formato JSON
    echo json_encode($detalles_producto);
} else {
    // Si no se recibió el ID del producto, devolver un mensaje de error
    echo json_encode(array('error' => 'No se proporcionó el ID del producto'));
}
?>
