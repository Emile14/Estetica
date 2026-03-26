@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark"><i class="fa-solid fa-users-gear me-2"></i>Gestión de Personal</h2>
            <p class="text-muted">Administración de accesos para la estética</p>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn btn-dark px-4 shadow-sm">
            <i class="fa-solid fa-user-plus me-1"></i> Nuevo Usuario
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nombre</th>
                            <th>Email / Teléfono</th>
                            <th>Rol</th>
                            <th class="text-center pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $usuario->nombre }}</div>
                                <small class="text-muted">ID: #{{ $usuario->id }}</small>
                            </td>
                            <td>
                                <div>{{ $usuario->email }}</div>
                                <small class="text-muted"><i class="fa-solid fa-phone fa-xs me-1"></i>{{ $usuario->telefono }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $usuario->rol == 'Administrador' ? 'bg-danger' : ($usuario->rol == 'Recepcionista' ? 'bg-primary' : 'bg-info text-dark') }}">
                                    {{ $usuario->rol }}
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group shadow-sm">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-white btn-sm border" title="Editar">
                                        <i class="fa-solid fa-pen text-primary"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm border" onclick="return confirm('¿Eliminar este usuario?')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection