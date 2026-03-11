<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
</head>
<body>
    <h2>Inventario de Productos</h2>
    <a href="{{ route('productos.create') }}">Añadir Producto</a>
    <hr>
    <ul>
        @foreach($productos as $producto)
            <li>
                <strong>{{ $producto->nombre }}</strong> - ${{ $producto->precio }}<br>
                {{ $producto->descripcion }}<br>
                <img src="{{ $producto->imagen_url }}" alt="Imagen" width="100"><br>
                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>