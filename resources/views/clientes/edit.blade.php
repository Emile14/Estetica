<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - Blanca Glow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Información del Cliente</h2>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border">
        <div class="card-body p-4">
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">User ID</label>
                    <input type="number" name="user_id" class="form-control" value="{{ $cliente->user_id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $cliente->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $cliente->email }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>