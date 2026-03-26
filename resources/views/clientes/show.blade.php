<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil Cliente - Blanca Glow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="card border-dark">
        <div class="card-header bg-dark text-white">
            <h3>Perfil del Cliente #{{ $cliente->id }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $cliente->apellido }}</p>
            <hr>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>
</body>
</html>