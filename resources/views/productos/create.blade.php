@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('productos.index') }}" class="text-gray-400 hover:text-rosa-fuerte transition duration-200">
            <i class="bi bi-arrow-left-circle-fill text-3xl"></i>
        </a>
        <h2 class="text-3xl font-playfair font-bold text-oscuro">Agregar Nuevo Producto</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-t-[5px] border-rosa-fuerte p-8">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf <div class="space-y-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del producto</label>
                    <input type="text" name="nombre" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition" 
                        placeholder="Ej. Shampoo Matizador Platinum">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Descripción</label>
                    <textarea name="descripcion" rows="3" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition" 
                        placeholder="Detalla los beneficios y uso del producto..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Precio de Venta ($)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500 font-bold">$</span>
                            <input type="number" step="0.01" name="precio" required
                                class="w-full pl-8 pr-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition" 
                                placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stock Inicial (Unidades)</label>
                        <input type="number" name="stock" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition" 
                            placeholder="Ej. 15">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">URL de la imagen</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400"><i class="bi bi-link-45deg"></i></span>
                        <input type="url" name="imagen" 
                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-200 focus:border-rosa-fuerte focus:ring-4 focus:ring-rosa-glow/50 outline-none transition" 
                            placeholder="https://ejemplo.com/imagen.jpg">
                    </div>
                    <small class="text-gray-400 mt-1 block">Opcional. Pega el enlace directo a la fotografía del producto.</small>
                </div>

                <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('productos.index') }}" 
                        class="px-6 py-2.5 rounded-lg font-semibold text-gray-600 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                        class="bg-rosa-fuerte text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm hover:bg-[#b87a80] transition flex items-center gap-2">
                        <i class="bi bi-save2"></i> Guardar Producto
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection