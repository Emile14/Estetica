<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Producto</title>
</head>
<body>
    <h2>Agregar Nuevo Producto</h2>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre del producto" required><br><br>
        <textarea name="descripcion" placeholder="Descripción" required></textarea><br><br>
        <input type="number" name="precio" step="0.01" placeholder="Precio" required><br><br>
        <input type="text" name="imagen_url" placeholder="URL de la imagen"><br><br>
        <button type="submit">Guardar Producto</button>
    </form>
</body>
</html>