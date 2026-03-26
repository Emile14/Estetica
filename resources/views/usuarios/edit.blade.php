<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Blanca Glow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .form-container { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        .btn-save { background-color: #000; color: #fff; border-radius: 8px; transition: 0.3s; }
        .btn-save:hover { background-color: #333; color: #fff; }
    </style>
</head>
<body class="py-5">

<div class="container">
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-dark"><i class="fa-solid fa-user-pen me-2"></i>Editar Usuario</h2>
        <p class="text-muted">Modificando a: <strong>{{ $usuario->nombre }}</strong></p>
    </div>

    <div class="form-container">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $usuario->telefono }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Rol en el Sistema</label>
                <select name="rol" class="form-select" required>
                    @foreach($roles as $rol)
                        <option value="{{ $rol }}" {{ $usuario->rol == $rol ? 'selected' : '' }}>
                            {{ $rol }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-save px-4 py-2">
                    <i class="fa-solid fa-check me-1"></i> Actualizar Información
                </button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-light border">
                    Cancelar y volver
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>