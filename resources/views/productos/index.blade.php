<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Productos - Blanca Glow</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .table-container { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-add { background-color: #000; color: #fff; border-radius: 8px; transition: 0.3s; }
        .btn-add:hover { background-color: #333; color: #fff; }
        .badge-stock { font-size: 0.85em; padding: 5px 10px; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark"><i class="fa-solid fa-boxes-stacked me-2"></i>Inventario de Productos</h2>
                <p class="text-muted">Gestión de stock y precios de Blanca Glow</p>
            </div>
            <a href="{{ route('productos.create') }}" class="btn btn-add px-4 py-2">
                <i class="fa-solid fa-plus me-1"></i> Nuevo Producto
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3">Nombre del Producto</th>
                            <th class="py-3">Categoría</th>
                            <th class="py-3">Precio</th>
                            <th class="py-3">Stock</th>
                            <th class="py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td class="fw-bold">#{{ $producto->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <div class="fw-bold text-dark">{{ $producto->nombre }}</div>
                                        <small class="text-muted">{{ Str::limit($producto->descripcion, 40) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="text-secondary">{{ $producto->categoria ?? 'General' }}</span></td>
                            <td class="fw-bold text-success">${{ number_format($producto->precio, 2) }}</td>
                            <td>
                                @if($producto->stock > 5)
                                    <span class="badge bg-success-subtle text-success badge-stock">En Stock ({{ $producto->stock }})</span>
                                @elseif($producto->stock > 0)
                                    <span class="badge bg-warning-subtle text-warning badge-stock">Bajo Stock ({{ $producto->stock }})</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger badge-stock">Agotado</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm" role="group">
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar producto?')" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3 d-block"></i>
                                No hay productos registrados aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>