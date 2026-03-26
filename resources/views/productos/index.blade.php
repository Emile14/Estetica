@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark"><i class="fa-solid fa-boxes-stacked me-2"></i>Inventario de Productos</h2>
            <p class="text-muted">Stock y precios de Blanca Glow</p>
        </div>
        {{-- Solo Admin puede crear --}}
        @if(Auth::user()->rol == 'Administrador')
            <a href="{{ route('productos.create') }}" class="btn btn-dark px-4 shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Nuevo Producto
            </a>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Producto</th>
                        <th>Precio</th>
                        {{-- Solo Admin ve la columna de acciones --}}
                        @if(Auth::user()->rol == 'Administrador')
                            <th class="text-center pe-4">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $producto->nombre }}</div>
                            <small class="text-muted">{{ Str::limit($producto->descripcion, 60) }}</small>
                        </td>
                        <td>
                            <span class="text-success fw-bold">${{ number_format($producto->precio, 2) }}</span>
                        </td>
                        @if(Auth::user()->rol == 'Administrador')
                        <td class="text-center pe-4">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-white btn-sm border">
                                    <i class="fa-solid fa-pen text-primary"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-white btn-sm border" onclick="return confirm('¿Eliminar producto?')">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection