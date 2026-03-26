<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes - Blanca Glow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Directorio de Clientes - Blanca Glow</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">Añadir Cliente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                <th>user_id</th>
                <th>nombre</th>
                <th>email</th>
                <th>telefono</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td class="align-middle">{{ $cliente->id }}</td>
                <td class="align-middle">{{ $cliente->user_id }}</td>
                <td class="align-middle">{{ $cliente->nombre }}</td>
                <td class="align-middle">{{ $cliente->email }}</td>
                <td class="align-middle">{{ $cliente->telefono }}</td>
                <td class="text-center align-middle">
                    
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cliente?')">Borrar</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>