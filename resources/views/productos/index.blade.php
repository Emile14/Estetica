@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-playfair font-bold text-oscuro flex items-center gap-3">
            <i class="bi bi-box-seam text-rosa-fuerte"></i> Inventario
        </h2>
        <a href="{{ route('productos.create') }}" class="bg-rosa-fuerte text-white px-5 py-2.5 rounded-lg shadow-sm hover:bg-[#b87a80] transition font-semibold flex items-center gap-2">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        <th class="py-4 px-6 font-semibold">Producto</th>
                        <th class="py-4 px-6 font-semibold">Stock</th>
                        <th class="py-4 px-6 font-semibold">Precio</th>
                        <th class="py-4 px-6 font-semibold text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($productos as $producto)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 font-bold text-oscuro">{{ $producto->nombre }}</td>
                        <td class="py-4 px-6">
                            <span class="{{ $producto->stock < 5 ? 'text-red-600 bg-red-50' : 'text-emerald-600 bg-emerald-50' }} px-3 py-1 rounded-full text-xs font-bold">
                                {{ $producto->stock }} pz
                            </span>
                        </td>
                        <td class="py-4 px-6 text-gray-600 font-semibold">${{ number_format($producto->precio, 2) }}</td>
                        <td class="py-4 px-6 text-center">
                            <a href="{{ route('productos.edit', $producto->id) }}" class="text-blue-500 hover:text-blue-700 mx-2"><i class="bi bi-pencil-square text-lg"></i></a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('¿Eliminar producto?')"><i class="bi bi-trash3-fill text-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-12 text-center text-gray-400">El inventario está vacío.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection