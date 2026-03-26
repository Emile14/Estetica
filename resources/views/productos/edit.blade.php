<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Blanca Glow</title>
    {{-- Importamos los mismos estilos que tu index --}}
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
            <h2 class="fw-bold text-dark"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Producto</h2>
            <p class="text-muted">Modifica la información de: <strong>{{ $producto->nombre }}</strong></p>
        </div>

        <div class="form-container">
            {{-- La ruta debe coincidir con el nombre que tienes en tu controlador --}}
            <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                @csrf
                @method('PATCH') {{-- Esto es vital para que Laravel reconozca la actualización --}}

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre del Producto</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $producto->descripcion }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Precio</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="precio" class="form-control" value="{{ $producto->precio }}" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-save px-4 py-2">
                        <i class="fa-solid fa-check me-1"></i> Actualizar Producto
                    </button>
                    <a href="{{ route('productos.index') }}" class="btn btn-light border">
                        Cancelar y volver
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>